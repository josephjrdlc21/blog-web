import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../store/authStore';

import Index from '../views/Index.vue';

import AuthLogin from '../views/auth/AuthLogin.vue';
import AuthRegister from '../views/auth/AuthRegister.vue';

import UsersIndex from '../views/users/UsersIndex.vue';
import UsersShow from '../views/users/UsersShow.vue';
import UsersCreate from '../views/users/UsersCreate.vue';
import UsersEdit from '../views/users/UsersEdit.vue';

import CategoriesIndex from '../views/categories/CategoriesIndex.vue';
import CategoriesCreate from '../views/categories/CategoriesCreate.vue';
import CategoriesEdit from '../views/categories/CategoriesEdit.vue';

import PagesIndex from '../views/pages/PagesIndex.vue';
import PagesShow from '../views/pages/PagesShow.vue';
import PagesCreate from '../views/pages/PagesCreate.vue';
import PagesEdit from '../views/pages/PagesEdit.vue';

import FaqIndex from '../views/faq/FaqIndex.vue';
import FaqCreate from '../views/faq/FaqCreate.vue';
import FaqEdit from '../views/faq/FaqEdit.vue';
import FaqShow from '../views/faq/FaqShow.vue';

import PrivacyIndex from '../views/privacy/PrivacyIndex.vue';

import ProfileIndex from '../views/profile/ProfileIndex.vue';
import ProfileChangePassword from '../views/profile/ProfileChangePassword.vue';

import NotFound from '../views/errors/404.vue';

const routes = [
    { path: '/backoffice/', name: 'Index', component: Index, meta: { requiresAuth: true } },

    { path: '/backoffice/login', name: 'AuthLogin', component: AuthLogin, meta: { guest: true } },
    { path: '/backoffice/register', name: 'AuthRegister', component: AuthRegister, meta: { guest: true } },

    { path: '/backoffice/users', name: 'UsersIndex', component: UsersIndex, meta: { requiresAuth: true } },
    { path: '/backoffice/users/create', name: 'UsersCreate', component: UsersCreate, meta: { requiresAuth: true } },
    { path: '/backoffice/users/edit/:id', name: 'UsersEdit', component: UsersEdit, meta: { requiresAuth: true } },
    { path: '/backoffice/users/show/:id', name: 'UsersShow', component: UsersShow, meta: { requiresAuth: true } },

    { path: '/backoffice/categories', name: 'CategoriesIndex', component: CategoriesIndex, meta: { requiresAuth: true } },
    { path: '/backoffice/categories/create', name: 'CategoriesCreate', component: CategoriesCreate, meta: { requiresAuth: true } },
    { path: '/backoffice/categories/edit/:id', name: 'CategoriesEdit', component: CategoriesEdit, meta: { requiresAuth: true } },

    { path: '/backoffice/pages', name: 'PagesIndex', component: PagesIndex, meta: { requiresAuth: true } },
    { path: '/backoffice/pages/create', name: 'PagesCreate', component: PagesCreate, meta: { requiresAuth: true } },
    { path: '/backoffice/pages/edit/:id', name: 'PagesEdit', component: PagesEdit, meta: { requiresAuth: true } },
    { path: '/backoffice/pages/show/:id', name: 'PagesShow', component: PagesShow, meta: { requiresAuth: true } },

    { path: '/backoffice/faq', name: 'FaqIndex', component: FaqIndex, meta: { requiresAuth: true } },
    { path: '/backoffice/faq/create', name: 'FaqCreate', component: FaqCreate, meta: { requiresAuth: true } },
    { path: '/backoffice/faq/edit/:id', name: 'FaqEdit', component: FaqEdit, meta: { requiresAuth: true } },
    { path: '/backoffice/faq/show/:id', name: 'FaqShow', component: FaqShow, meta: { requiresAuth: true } },

    { path: '/backoffice/privacy', name: 'PrivacyIndex', component: PrivacyIndex, meta: { requiresAuth: true } },

    { path: '/backoffice/profile', name: 'ProfileIndex', component: ProfileIndex, meta: { requiresAuth: true } },
    { path: '/backoffice/profile/change-password', name: 'ProfileChangePassword', component: ProfileChangePassword, meta: { requiresAuth: true } },

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