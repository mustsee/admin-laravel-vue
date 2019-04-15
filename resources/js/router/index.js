import VueRouter from "vue-router";

import Home from './../components/Home';

import Users from '../components/User';
import CreateUser from './../components/User/create';

import Monuments from './../components/Monuments';


const routes = [
    { path: '/', component: Home },
    { path: '/users', component: Users },
    { path: '/users/create', component: CreateUser },
    { path: '/monuments', component: Monuments }
];

const router = new VueRouter({
    routes
});

export { router }