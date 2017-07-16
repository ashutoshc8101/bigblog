<template>
    <div>
        <div class="comment" v-for="comment in comments">
            <div class="user">
                <span class="dp"><img src="#" /></span>
                <span>{{ comment.user.name }}</span>
            </div>
            <div class="comment-body">
                {{ comment.body }}
            </div>

            <hr>
        </div>
    </div>
</template>

<script>
export default {

    props: ["slug"],

    data(){
        return {
            comments : []
        }
    },

    created(){

        this.$http.get("/blog/comments/" + this.slug).then(function(data){
            return data.json();
        }).then(function(data){
            console.log(data);
            this.comments = data;
        });

    }

}


</script>