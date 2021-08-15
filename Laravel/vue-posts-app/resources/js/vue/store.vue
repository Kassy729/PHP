<template>
    <div>
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title" v-model="post.title"><br>
        <label for="content">Content</label><br>
        <input type="text" name="content" id="content" v-model="post.content"><br><br>
        <!-- <font-awesome-icon icon="plus-square" @click="addPost()"></font-awesome-icon> -->
        <button type="submit" @click="addPost()">제출</button>
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
            axios.post('api/posts/store', {
                title: this.title,
                content: this.content
            })
            .then(response => {
                if(response.status == 201){
                    this.post.title = "";
                    this.post.content = "";
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
.addItem{
    display: flex;
    justify-content: center;
    align-content: center;
}
input{
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.plus{
    font-size: 20px;
}
.active{
    color: #00CE25;
}
.inactive{
    color: #999999;
}
</style>