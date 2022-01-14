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
          <router-link to="/login" class="btn btn-outline-light me-2"
            >Login</router-link
          >
          <a href="javascript:void(0)" class="btn btn-outline-light me-2"
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
export default {
  name: "Nav",
  methods: {},
};
</script>
