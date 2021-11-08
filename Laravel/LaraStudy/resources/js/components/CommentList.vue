<template>
    <div>
        <link
            href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css"
            rel="stylesheet"
        />

        <label class="block text-left" style="max-width: 400px">
            <form @submit.prevent="addComment">
                <button class="text-gray-700">댓글작성</button>
                <textarea
                    v-model="newComment"
                    class="form-textarea mt-1 block w-full"
                    rows="3"
                    placeholder="Enter some long form content."
                ></textarea>
            </form>
        </label>

        <button @click="getComment" class="btn btn-default">
            댓글 불러오기
        </button>

        <comment-item
            v-for="(comment, index) in comments.data"
            :key="index"
            :comment="comment"
            :login_user_id="loginuser"
        />

        <pagination
            @pageClicked="getPage"
            v-if="comments.links != null"
            :links="comments.links"
        />
    </div>
</template>

<script>
import CommentItem from "./CommentItem.vue";
import Pagination from "./Pagination.vue";

export default {
    components: {
        CommentItem,
        Pagination
    },
    props: ["post", "loginuser"],
    data() {
        return {
            comments: [],
            newComment: ""
        };
    },
    methods: {
        addComment() {
            if (this.newComment == "") {
                alert("댓글 써야해요!");
                return;
            }
            axios
                .post(`/comments/${this.post.id}`, { comment: this.newComment })
                .then(res => {
                    this.getComment();
                    this.newComment = "";
                })
                .catch(err => {
                    console.log(err);
                });
        },

        getPage(url) {
            console.log(url);
            axios
                .get(url)
                .then(res => {
                    console.log(res);
                    this.comments = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        getComment() {
            //서버에 현재 게시글의 댓글 리스트를 비동기적으로 요청
            //즉, axios를 이용해서 요청
            //서버가 댓글 리스트를 주면 그놈을 어디에 할당해?
            //this.comments에 할당
            axios
                .get(`/comments/${this.post.id}`)
                .then(res => {
                    this.comments = res.data;
                    console.log(this.comments);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
