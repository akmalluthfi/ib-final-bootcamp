import store from './store';
import VueRouter from 'vue-router';
import { routes } from './routes'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faBell } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Vue from 'vue';

require('./bootstrap');

window.Vue = require('vue').default;
library.add(faBell);

Vue.component('app-comp', require('./components/AppComp.vue').default);
Vue.component('Navbar', require('./components/Layout/Navbar.vue').default);
Vue.component('Layout', require('./components/Layout/Layout.vue').default);
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.use(VueRouter);
const router = new VueRouter({
    mode: "history",
    routes
})

const app = new Vue({
    el: '#app',
    store,
    router
});
