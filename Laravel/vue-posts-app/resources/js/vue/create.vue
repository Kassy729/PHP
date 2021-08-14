<template>
    <div class="addItem">
        <label for="title">Title</label>
        <input type="text" v-model="post.title"/><br><br>
        <label for="content">Content</label>
        <input type="text" v-model="post.content"><br><br>
        <button @click="addPost()">작성</button>
    </div>
</template>


<script>
export default {
    data: function(){
        return {
            post:{
                title:"",
                content:"",
            }
        }
    },
    methods:{
        addPost(){
            if(this.post.title == '' || this.post.content == '')
                return;
            
            axios.post('api/posts/store', {
                post: this.post
            })
            .then(response => {
                if(response.status == 201){
                    this.post.title="";
                    this.post.content="";
                    // this.$emit('')
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }    
}
</script>

