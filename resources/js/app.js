import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css';
require('./bootstrap');

window.Vue = require('vue');

Vue.component('app-component', require('./components/AppComponent.vue').default);

Vue.use(Vuetify);
Vue.use(VueRouter);
const router = new VueRouter({
    routes: [
        {
            path: '/',
            redirect: '/task',
        },
        {
            path: '/task',
            name: 'task',
            component: () => import('./components/task/Task.vue'),
        },
        {
            path: '/search',
            name: 'search',
            component: () => import('./components/search/Search.vue'),
        },
        {
            path: '/user',
            name: 'user',
            component: () => import('./components/user/User.vue'),
        },
    ]
});

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify()
});
