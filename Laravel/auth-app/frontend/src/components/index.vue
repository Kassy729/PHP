<template>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">제목</th>
        <th scope="col">내용</th>
      </tr>
    </thead>
    <tbody v-for="post in posts.data" :key="post.id">
      <tr>
        <th scope="row">{{ post.id }}</th>
        <td @click="onClickPost(post.id)">{{ post.title }}</td>
        <td>{{ post.content }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      posts: [],
    };
  },

  mounted() {
    axios
      .get("http://localhost:8000/api/index")
      .then((res) => {
        this.posts = res.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },

  methods: {
    onClickPost(postId) {
      this.$router.push({ path: "/show/" + postId });
    },
  },
};
</script>
