import VueRouter from "vue-router";

import Home from './../components/Home';

import Users from '../components/User';
import CreateUser from './../components/User/create';

import Languages from '../components/Language';
import CreateLanguage from '../components/Language/create';

import Monuments from './../components/Monuments';


const routes = [
    { path: '/', component: Home, name: 'Home'},
    { path: '/users', component: Users, name: 'Users'},
    { path: '/users/create', component: CreateUser, name: 'Create User'},
    { path: '/languages', component: Languages, name: 'Languages'},
    { path: '/languages/create', component: CreateLanguage, name: 'Create Language'},
    { path: '/monuments', component: Monuments, name: 'Monuments'}
];

const router = new VueRouter({
    routes
});

export { router }