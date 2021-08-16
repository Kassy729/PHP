<template>
    <div>
        <div class="heading">
            <h2 id="title">게시판</h2>
            <create></create>
        </div>

    </div>    
</template>

<script>
import func from 'vue-editor-bridge'
import create from './create'
import listPost from "./listPost.vue"

export default {
    components:{
        create,
        listPost
    },
    
}
</script>

