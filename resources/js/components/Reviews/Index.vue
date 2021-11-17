
<template>
    <div>
        <h4 class="card-title">Latest Reviews</h4>
        <div v-if="errorServer " class="alert alert-danger">
            <ul>
                <li > {{ errorServer }}</li>
            </ul>
        </div>
        <div class="col-lg-12" v-for="review in reviews.data" :key="review.id">
            <div class="card">
                <div class="comment-widgets w-100">
                    <div class="d-flex flex-row comment-row m-t-0">
                        <div class="comment-text w-100">
                            <h6 class="font-medium">{{ review.author}}  <teamplate v-for="index in review.stars" :key="index"><i class="fa fa-star"></i></teamplate></h6> 
                            <span class="m-b-15 d-block">{{ review.comment}}</span>
                            <div class="comment-footer"> <span class="text-muted float-right">{{review.created_at}}</span> </div>
                        </div>
                    </div> <!-- Comment Row -->
                </div> <!-- Card -->
            </div>
        </div>
        <div v-if="login" class="col-12 mt-4">
            <reviews-create :book="book" v-on:updateIndex="getBooks()" ></reviews-create>
        </div>
        <div v-else>
            <div class="col-12 mt-4">
                <div class="alert alert-danger" role="alert">
                    <a v-bind:href="loginRoute" >Log in</a> or <a v-bind:href="registerRoute" > register  </a > to leave review!
                </div>
            </div>
        </div>
    </div>

</template>

<script>
        import ReviewCreate from './Create.vue';
        export default {
            name: 'ReviewIndex',
            props:{
                book:{
                    type: Object,
                    required: true,
                },
                login:'',
            },
            data(){
                return {
                    reviews: [],
                    errorServer: '',
                    registerRoute: window.location.origin + '/register',
                    loginRoute: window.location.origin + '/login',
                }
             },

            mounted() {
                console.log(window.location.origin + '/register');
                this.getBooks();
            },
            methods:{
                getBooks(){
                    axios.get(`/api/v1/reviews/${this.book.id}`).then(response => {
                        this.reviews = response.data;
                    }).catch((error) => {
                        this.errorServer = 'Cant load reviews, server error';
                    }) ;
                }
            },
            components:{
                'reviews-create': ReviewCreate,
            }
        }
</script>