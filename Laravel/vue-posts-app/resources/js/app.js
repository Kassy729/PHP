require('./bootstrap');

require('alpinejs');

import Vue from 'vue'
import Create from './vue/create'


import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add( faPlusSquare, faSquare )

Vue.component('font-awesome-icon', FontAwesomeIcon)


const create = new Vue({
    el: '#create',
    components: { Create }
});
