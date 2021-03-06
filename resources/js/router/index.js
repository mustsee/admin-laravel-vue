import VueRouter from "vue-router";

import Home from './../components/Home';

import Users from '../components/User';
import CreateUser from './../components/User/create';

import Languages from '../components/Language';
import CreateLanguage from '../components/Language/create';

import Monuments from './../components/Monument';
import EditMonument from './../components/Monument/edit';

import EditMonumentTranslation from './../components/Monument/translations/edit.vue';

const routes = [
    { path: '/', component: Home, name: 'Home'},
    { path: '/users', component: Users, name: 'Users'},
    { path: '/users/create', component: CreateUser, name: 'Create User'},
    { path: '/languages', component: Languages, name: 'Languages'},
    { path: '/languages/create', component: CreateLanguage, name: 'Create Language'},
    { path: '/monuments', component: Monuments, name: 'Monuments'},
    { path: '/monuments/edit', component: EditMonument, name: 'Create Monument'},
    { path: '/monuments/:id/edit', component: EditMonument, name: 'Update Monument'},
    { path: '/monuments/:monument_id/translations/edit', component: EditMonumentTranslation, name: 'Create Monument Translation'},
    { path: '/monuments/:monument_id/translations/:translation_id/edit', component: EditMonumentTranslation, name: 'Update Monument Translation'},
];

const router = new VueRouter({
    routes
});

export { router }