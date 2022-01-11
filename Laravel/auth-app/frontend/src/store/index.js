import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    user: null,
    token: "",
  },
  getters: {
    user: (state) => {
      return state.user;
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        await axios
          .post("http://localhost:8000/api/login", credentials)
          .then((res) => {
            commit("setToken", res.data);
            this.$store.dispatch("user", res.data.user);
          });
      } catch (err) {
        console.log(err);
      }
    },
    user(context, user) {
      context.commit("user", user);
    },
  },
  mutations: {
    setToken(state, data) {
      state.token = data.token;
      localStorage.setItem("access-token", data.token);
    },
    user(state, user) {
      state.user = user;
      console.log(state.user);
    },
  },
});

export default store;
