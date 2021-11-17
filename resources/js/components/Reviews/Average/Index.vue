<template>
    <div class="col-4 align-self-end">
        <div class="d-flex">
            <div class="content text-center" v-if="reviews.review_count > 0">
                <div class="ratings"> <span class="product-rating">{{ reviews.avg_rating  }} / 5</span>
                    <div class="stars" >
                            <i class="fa fa-star" v-for="index in Math.floor(reviews.avg_rating )"  :key="index"></i>
                    </div>
                    <div class="rating-text"> out of {{ reviews.review_count }} reviews</div>
                </div>
            </div>
            <div class="ratings" v-else>
                    No reviews yet
            </div>
        </div>
    </div>    
</template>


<script>
import {bus} from '../../../app.js';
export default {
    props:{
        book:{
            type: Object,
            required: true
        }
    },
    data(){
        return {
            reviews:[

            ],   
        }
    },  
    mounted(){
        this.getAvgReview();

    },
    created(){
        bus.$on('updateReviewCount', (data) =>{
            this.getAvgReview();
        });
    },
    methods:{
        getAvgReview(){
            axios.get(`/api/v1/reviews/average/${this.book.id}`).then( (response) => {
                this.reviews = response.data.data;

            });
        }
    }
}
</script>