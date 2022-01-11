<template>
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"
      >
        <a
          href="/"
          class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"
        >
          <svg
            class="bi me-2"
            width="40"
            height="32"
            role="img"
            aria-label="Bootstrap"
          >
            <use xlink:href="#bootstrap" />
          </svg>
        </a>

        <ul
          class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"
        >
          <li>
            <router-link to="/" class="nav-link px-2 text-secondary"
              >Home</router-link
            >
          </li>
        </ul>

        <div class="text-end">
          <router-link
            to="/login"
            class="btn btn-outline-light me-2"
            v-if="this.user == null"
            >Login</router-link
          >
          <a
            href="javascript:void(0)"
            @click="handleClick"
            v-else
            class="btn btn-outline-light me-2"
            >Logout</a
          >

          <router-link to="/register" class="btn btn-warning"
            >Sign-up</router-link
          >
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "Nav",
  computed: {
    ...mapGetters(["user"]),
  },
  methods: {
    handleClick() {
      localStorage.removeItem("access-token");
      this.$router.push({ name: "Home" });
    },
    // getUser() {
    //   if (this.$store.state.token) {
    //     axios
    //       .get("http://localhost:8000/api/user")
    //       .then((res) => {
    //         this.user = res.data;
    //       })
    //       .catch((err) => {
    //         console.log(err);
    //       });
    //   }
    //   return console.log("토큰이 없어서 못불러옵니다");
    // },
  },
};
</script>
