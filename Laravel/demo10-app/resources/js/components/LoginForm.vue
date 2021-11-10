<template>
    <div>
        <div>
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
                rel="stylesheet"
                integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
                crossorigin="anonymous"
            />
        </div>
        <div class="mb-3 row">
            <label for="exampleInputEmail1" class="col-sm-2 col-form-label"
                >Email</label
            >
            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control-plaintext"
                    id="staticEmail"
                    v-model="user.email"
                    value="email@example.com"
                />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label"
                >Password</label
            >
            <div class="col-sm-10">
                <input
                    type="password"
                    class="form-control"
                    id="inputPassword"
                    v-model="user.password"
                />
            </div>
            <button type="submit" @click="login" class="btn btn-primary mt-4">
                Submit
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        login() {
            this.$store.dispatch("currentUser/loginUser", this.user);
        },
    },
};
</script>

<style scoped>
.class {
    text-align: center;
}
.container {
    max-width: 500px;
}
</style>
