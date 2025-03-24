import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../store/authStore';

import Index from '../views/Index.vue';

import AuthLogin from '../views/auth/AuthLogin.vue';
import AuthRegister from '../views/auth/AuthRegister.vue';

import UsersIndex from '../views/users/UsersIndex.vue';
import UsersShow from '../views/users/UsersShow.vue';
import UsersCreate from '../views/users/UsersCreate.vue';
import UsersEdit from '../views/users/UsersEdit.vue';

import NotFound from '../views/errors/404.vue';

const routes = [
    { path: '/backoffice/', name: 'Index', component: Index, meta: { requiresAuth: true } },

    { path: '/backoffice/login', name: 'AuthLogin', component: AuthLogin, meta: { guest: true } },
    { path: '/backoffice/register', name: 'AuthRegister', component: AuthRegister, meta: { guest: true } },

    { path: '/backoffice/users', name: 'UsersIndex', component: UsersIndex, meta: { requiresAuth: true } },
    { path: '/backoffice/users/create', name: 'UsersCreate', component: UsersCreate, meta: { requiresAuth: true } },
    { path: '/backoffice/users/edit/:id', name: 'UsersEdit', component: UsersEdit, meta: { requiresAuth: true } },
    { path: '/backoffice/users/show/:id', name: 'UsersShow', component: UsersShow, meta: { requiresAuth: true } },

    { path: '/backoffice/:pathMatch(.*)*', name: 'NotFound', component: NotFound }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    const auth = useAuthStore();

    if (to.meta.requiresAuth && !auth.user) {
        return { name: 'AuthLogin' };
    }

    if (to.meta.guest && auth.user) {
        return { name: 'Index' };
    }
});

export default router;