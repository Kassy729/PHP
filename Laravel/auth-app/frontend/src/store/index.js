import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    authenticated: false,
  },
  mutations: {
    setAuth(state, data) {
      state.authenticated = data;
    },
  },
  getters: {},

  actions: {
    setAuth({ commit }, auth) {
      commit("setAuth", auth);
    },
  },
});

export default store;
