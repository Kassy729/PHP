<template>
  <div>
    <div>제목 : {{ post.title }}</div>
    <div>내용 : {{ post.content }}</div>
    <div>작성자 : {{ post.user.name }}</div>
    <Comment :user_id="post.user.id" :post="post" />
  </div>
</template>

<script>
import axios from "axios";
import Comment from "../components/Comment.vue";
export default {
  components: { Comment },
  data() {
    return {
      post: [],
    };
  },
  mounted() {
    this.getPost();
  },

  methods: {
    getPost() {
      axios
        .get("http://localhost:8000/api/show/" + this.$route.params.postId)
        .then((res) => {
          this.post = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
