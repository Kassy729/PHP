<template>
  <div>
    <div>{{ user.name }}</div>
    <div>{{ user.email }}</div>
    <div>{{ message }}</div>
    <div>{{ this.$store.state.authenticated }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Home",
  data() {
    return {
      user: [],
      message: "",
    };
  },

  mounted() {
    axios
      .get("http://localhost:8000/api/user")
      .then((res) => {
        this.user = res.data;
        this.$store.dispatch("setAuth", true);
      })
      .catch(() => {
        this.message = "Your not logged in";
        this.$store.dispatch("setAuth", false);
      });
  },
};
</script>
