require('./bootstrap');

require('alpinejs');

import Vue from 'vue'

import App from './vue/app'

const app = new Vue({
    el: '#app',
    components:{ App }
})