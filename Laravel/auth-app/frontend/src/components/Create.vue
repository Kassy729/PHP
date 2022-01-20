<template>
  <div>
    <form ref="form" @submit.prevent="onsubmitForm">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"
          >Email address</label
        >
        <input
          class="form-control"
          id="exampleFormControlInput1"
          v-model="title"
          placeholder="제목"
        />
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Example textarea</label
        >
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="3"
          v-model="content"
        ></textarea>
      </div>
      <button class="btn btn-success" depressed type="submit">Post</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      title: "",
      content: "",
    };
  },
  props: ["user"],
  methods: {
    onsubmitForm() {
      const form = new FormData();
      form.append("title", this.title);
      form.append("content", this.content);
      form.append("id", this.user.id);
      axios
        .post("http://localhost:8000/api/store", form)
        .then((res) => {
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err);
          alert("실패");
        });
    },
  },
};
</script>
