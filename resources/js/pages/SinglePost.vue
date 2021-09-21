<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <h5 class="card-title">{{post.title}}</h5>
                <p class="card-text btn btn-success" v-if="post.category">
                    {{post.category.name}}
                </p>
                <p class="card-text btn btn-danger" v-else>
                    Non è stata assegnata nessuna categoria
                </p>
                <p class="card-text">{{post.content}}</p>
              
               <div v-if="post.tags">
                   <span class="badge badge-primary mx-2 p-2" v-for="tag in post.tags" :key="tag.id">
                       {{tag.name}}

                   </span>
               </div>

        
            </div>
        </div>
    </div>

</template>




<script>
export default {
    name: 'SinglePost',
    data(){
        return  {
            post: [],
        }
    },
    mounted(){
        axios.get('/api/post/' + this.$route.params.slug)
             .then(response=>{
                 this.post=response.data.results;
                // console.log(this.post)
             })
             .catch();
    }
}
</script>





<style lang="scss" scoped>

</style>