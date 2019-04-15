import VueRouter from 'vue-router'
import Vuetify from 'vuetify';

import 'vuetify/dist/vuetify.min.css';

require('./bootstrap');

window.Vue = require('vue');

import { router } from './router';

Vue.use(Vuetify);
Vue.use(VueRouter);

Vue.component('main-component', require('./components/MainComponent.vue').default);

const app = new Vue({
    router
}).$mount('#app');
