import { createRouter, createWebHistory } from 'vue-router';

import Index from '../views/Index.vue';

import UserIndex from '../views/users/UserIndex.vue';

const routes = [
    { path: '/', name: 'Index', component: Index },

    { path: '/users', name: 'UserIndex', component: UserIndex },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;