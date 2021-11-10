import Vue from "vue";
import Vuex from "vuex";
import currentUser from "./modules/currentUser";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        currentUser: currentUser,
    },
});

export default store;
