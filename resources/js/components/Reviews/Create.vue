<template>
<div class="col-12 justify-content-center" >
    <div class="card">
        <div class="card-body text-center">
            <h4 class="card-title">Leave Rview</h4>
        </div>
        <div class="comment-widgets">
            <!-- Comment Row -->
                <form @submit.prevent="submit_form()"> 
                    <div class="form-group">

                          <div v-if="errors && errors.comment" class="alert alert-danger">
                              <ul>
                                <li >{{ errors.comment[0] }}</li>
                              </ul>
                          </div>

                          <div v-if="errors && errors.stars" class="alert alert-danger">
                              <ul>
                                <li >{{ errors.stars[0] }}</li>
                              </ul>
                          </div>

                          <div v-if="errors.review" class="alert alert-danger">
                              <ul>
                                <li >{{ errors.review }}</li>
                              </ul>
                          </div>
                      <div v-if="success" class="alert alert-success">
                        {{ success }}
                      </div>

                        <label class="col-md-3 control-label" for="message">Your rating stars</label>
                        <div class="col-md-9">
                            <div class="rating">
                             <label>
                                <input type="radio" v-model="fields.stars" value="1" />
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" :v-model="fields.stars" name="stars" value="2" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" v-model="fields.stars" value="3" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>   
                              </label>
                              <label>
                                <input type="radio" v-model="fields.stars" value="4" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" v-model="fields.stars" value="5" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Your comment</label>
                        <div class="col-md-12">
                        <textarea class="form-control" id="message" v-model="fields.comment" placeholder="Please enter your feedback here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="d-flex justify-content-center">
                        <div class="col-6">
                          <button type="submit" class="btn-danger btn-block"
                            :disabled="form_submitting"
                          >Submit</button>
                        </div>
                      
                      </div>
                    </div>
                </form>
        </div> <!-- Card -->
    </div>
</div>
</template>

<script>
import { bus } from '../../app.js';
export default { 
    name:'ReviewCreate',
    props:{
      book:{
        type: Object,
        required: true,
      },
    },
    data(){
        return {
            review:{},
            fields:{
              'comment':'',
              'stars':'',
            },
            errors:{ review: ''},
            success: '',
            form_submitting: false,
        }
    },
    mounted(){
        
    },
    methods:{
      submit_form(){
        this.form_submitting = true;
        axios.post(`/api/v1/reviews/store/${this.book.id}`, this.fields)
          .then( ( response ) => {

            this.success = 'Tanks for review!';
            bus.$emit('updateReviewCount');
            this.$emit('updateIndex');
            this.form_submitting = false;
          }).catch( (error) => {
            if(error.response.status === 422 )
            {
              this.errors = error.response.data.errors;
            }
            if(error.response.status === 403 )
            {
              this.errors.review = error.response.data.message;
            }
            this.form_submitting = false;
          });
      }
    }
    
}
</script>