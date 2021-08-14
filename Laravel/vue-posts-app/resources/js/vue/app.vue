<template>
    <div class="postsContainer">
        <div>
            <h2>게시판입니다</h2>
            <create></create>
        </div>
    </div>
</template>

<script>
import create from './create.vue'

export default {
    components:{
        create
    },
    data: function(){
        return{
            posts:[]
        }
    },
    methods:{
        // getPost(){
        //     axios.get('api/')
        // }
    }
}
</script>