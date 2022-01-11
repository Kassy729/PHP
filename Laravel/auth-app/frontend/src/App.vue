<template>
  <div>
    <Nav />
    <router-view />
  </div>
</template>

<script>
import Nav from "./components/Nav.vue";
import axios from "axios";

export default {
  components: {
    Nav,
  },

  async created() {
    const token = localStorage.getItem("access-token");
    if (token) {
      axios.defaults.headers.common.Authorization = `Bearer ${token}`;
    } else return console.log("안된다");

    const response = await axios.get("http://localhost:8000/api/user");
    this.$store.dispatch("user", response.data);
  },
};
</script>

<style>
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
