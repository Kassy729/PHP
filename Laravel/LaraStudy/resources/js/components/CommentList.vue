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
    components: {
        CommentItem
    },
    props: ["post", "loginuser"],
    data() {
        return {
            comments: []
        };
    },
    methods: {
        getComment() {
            this.comments = [
                "1st comment",
                "2nd comment",
                "3rd comment",
                "4th comment",
                "5th comment"
            ];
        }
    }
};
</script>
