<template>
  <main class="form-signin">
    <form @submit.prevent="onsubmitRegister">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input class="form-control" v-model="name" />
        <label for="floatingInput">Name</label>
      </div>
      <div class="form-floating">
        <input
          type="email"
          class="form-control"
          placeholder="name@example.com"
          v-model="email"
        />
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input
          type="password"
          class="form-control"
          placeholder="Password"
          v-model="password"
        />
        <label for="floatingPassword">Password</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">
        Sign in
      </button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
  </main>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
    };
  },
  methods: {
    onsubmitRegister() {
      const form = new FormData();
      form.append("name", this.name);
      form.append("email", this.email);
      form.append("password", this.password);
      axios
        .post("http://localhost:8000/api/register", form)
        .then((res) => {
          console.log(res.data);
          this.$router.push("/login");
        })
        .catch((err) => {
          console.log(err);
          alert("실패");
        });
    },
  },
};
</script>
