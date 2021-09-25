require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './routes'

// import User class, make it Global
import User from './Helpers/User'
window.User = User;

// import Notification class, make it Global
import Notification from './Helpers/Notification'
window.Notification = Notification;

// import sweet alert, make it Global
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast;
// End sweetalert portion

Vue.use(VueRouter)
const router = new VueRouter({
    routes,
    mode: 'history'
})

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});