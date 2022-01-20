<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">댓글</th>
        </tr>
      </thead>
      <tbody v-for="comment in comments" :key="comment.id">
        <tr>
          <th scope="row">{{ comment.id }}</th>
          <td>
            {{ comment.comment }}
            <form ref="form" @submit.prevent="onsubmitForm">
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Recipient's username"
                  aria-label="Recipient's username"
                  aria-describedby="button-addon2"
                  v-model="reply"
                />
                <button
                  class="btn btn-outline-secondary"
                  type="submit"
                  id="button-addon2"
                >
                  Button
                </button>
              </div>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
    <form ref="form" @submit.prevent="onsubmitForm">
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          placeholder="Recipient's username"
          aria-label="Recipient's username"
          aria-describedby="button-addon2"
          v-model="comment"
        />
        <button
          class="btn btn-outline-secondary"
          type="submit"
          id="button-addon2"
        >
          Button
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["user_id", "post"],
  data() {
    return {
      comment: "",
      comments: [],
      reply: "",
    };
  },

  mounted() {
    this.getComment();
  },

  methods: {
    onsubmitForm() {
      const form = new FormData();
      form.append("comment", this.comment);
      form.append("user_id", this.user_id);
      axios
        .post("http://localhost:8000/api/comment/" + this.post.id, form)
        .then(() => {
          this.getComment();
          this.comment = "";
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getComment() {
      axios
        .get("http://localhost:8000/api/comment/" + this.post.id)
        .then((res) => {
          this.comments = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
