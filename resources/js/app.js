require('./bootstrap');

window.Vue = require('vue');

Vue.component('todo', require('./components/Todo.vue').default);


import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

const app = new Vue({
    el: '#app',
});
