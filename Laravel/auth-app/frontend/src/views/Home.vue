<template>
  <div>
    <div class="home">Home</div>
    <div v-if="user == null">You are not logged in</div>
    <div v-else>{{ this.user.name }}</div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "Home",
  computed: {
    ...mapGetters(["user"]),
  },

  // methods: {
  //   getUser() {
  //     if (this.$store.state.token) {
  //       axios
  //         .get("http://localhost:8000/api/user")
  //         .then((res) => {
  //           this.user = res.data;
  //         })
  //         .catch((err) => {
  //           console.log(err);
  //         });
  //     }
  //     return console.log("토큰이 없어서 못불러옵니다");
  //   },
  // },

  // created() {
  //   this.getUser();
  // },
};
</script>
