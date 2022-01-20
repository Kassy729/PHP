<template>
  <div>
    <Index />
    <Create :user="user" />
  </div>
</template>

<script>
import axios from "axios";
import Create from "../components/Create.vue";
import Index from "../components/index.vue";

export default {
  name: "Home",
  data() {
    return {
      user: [],
      message: "",
    };
  },

  components: {
    Create,
    Index,
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
