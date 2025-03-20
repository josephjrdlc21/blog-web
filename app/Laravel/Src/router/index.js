import { createRouter, createWebHistory } from 'vue-router';

import Index from '../views/Index.vue';

import AuthLogin from '../views/auth/AuthLogin.vue';
import AuthRegister from '../views/auth/AuthRegister.vue';

import UsersIndex from '../views/users/UsersIndex.vue';
import UsersShow from '../views/users/UsersShow.vue';
import UsersCreate from '../views/users/UsersCreate.vue';
import UsersEdit from '../views/users/UsersEdit.vue';

import NotFound from '../views/errors/NotFound.vue';

const routes = [
    { path: '/', name: 'Index', component: Index },

    { path: '/login', name: 'AuthLogin', component: AuthLogin },
    { path: '/register', name: 'AuthRegister', component: AuthRegister },

    { path: '/users', name: 'UsersIndex', component: UsersIndex },
    { path: '/users/create', name: 'UsersCreate', component: UsersCreate },
    { path: '/users/edit/:id', name: 'UsersEdit', component: UsersEdit},
    { path: '/users/show/:id', name: 'UsersShow', component: UsersShow },

    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;