import axios from "axios";

const state = {
    user: {},
};

const getters = {};
const actions = {
    loginUser({}, user) {
        axios
            .post("", {
                email: user.email,
                password: user.password,
            })
            .then((res) => {
                console.log(res.data);
            })
            .catch((err) => {
                console.log(err);
            });
    },
};
const mutations = {};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
