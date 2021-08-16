<template>
    <div class="postContainer">
        <div class="heading">
            <h2 id="title">게시판</h2>
            <store></store>
        </div>
    </div>
</template>

<script>
import store from './store.vue'

export default {
    components:{
        store
    },
    data: function(){
        return {
            posts: []
        }
    },
    methods:{
        
    },
}
</script>



<style scoped>
.todoListContainer{
    width: 350px;
    margin: auto;
}

.heading{
    background: #e6e6e6;
    padding: 10px;
}

#title{
    text-align: center;
}
</style>