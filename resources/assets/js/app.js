
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Home', require('./components/Home.vue'));
Vue.component('Contact', require('./components/Contact.vue'));
Vue.component('Faq', require('./components/Faq.vue'));
Vue.component('Register', require('./components/Register.vue'));
Vue.component('Login', require('./components/Login.vue'));
Vue.component('Admin', require('./components/AdminReg.vue'));

const app = new Vue({
    el: '#app'
});
