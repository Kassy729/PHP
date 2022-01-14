<template>
  <main class="form-signin">
    <form @submit.prevent="login">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <div class="form-floating">
        <input
          type="email"
          class="form-control"
          v-model="email"
          placeholder="name@example.com"
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
      {{ this.$store.state.token }}
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
  </main>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },

  methods: {
    login() {
      const form = new FormData();
      form.append("email", this.email);
      form.append("password", this.password);
      axios
        .post("http://localhost:8000/api/login", form)
        .then((res) => {
          console.log(res);
          this.$router.push("/");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
