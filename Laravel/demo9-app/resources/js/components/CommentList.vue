<template>
    <div>
        <button @click="getComment" class="btn btn-default">
            댓글 불러오기
        </button>
        <comment-item
            v-for="(comment, index) in comments"
            :key="index"
            :comment="comment"
        />
    </div>
</template>

<script>
import CommentItem from "./CommentItem.vue";

export default {
    components: { CommentItem },
    props: ["post", "loginuser"],
    data() {
        return {
            comments: []
        };
    },
    methods: {
        getComment() {
            this.comments = ["1번째", "2번째", "3번째"];
        }
    }
};
</script>
