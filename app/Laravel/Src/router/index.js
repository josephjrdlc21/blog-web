import { createRouter, createWebHistory } from 'vue-router';

import Index from '../views/Index.vue';

import UsersIndex from '../views/users/UsersIndex.vue';
import UsersShow from '../views/users/UsersShow.vue';

import NotFound from '../views/errors/NotFound.vue';

const routes = [
    { path: '/', name: 'Index', component: Index },

    { path: '/users', name: 'UsersIndex', component: UsersIndex },
    { path: '/users/:id', name: 'UsersShow', component: UsersShow },

    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;