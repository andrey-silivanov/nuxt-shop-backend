import Vue from 'vue';
import VueRouter from "vue-router";

import DashboardLayout from '@/pages/Layout/DashboardLayout.vue'
import AuthLayout from '@/pages/Layout/AuthLayout.vue'

import Dashboard from '@/pages/Dashboard.vue'
import UserProfile from '@/pages/UserProfile.vue'
import Login from '@/pages/auth/Login'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: DashboardLayout,
        redirect: '/dashboard',
        meta: {
            auth: true
        },
        children: [
            {
                path: 'dashboard',
                name: 'Dashboard',
                component: Dashboard
            },
            {
                path: 'user',
                name: 'User Profile',
                component: UserProfile
            },
        ]
    },
    {
        path: '/auth',
        component: AuthLayout,
        redirect: '/login',
        children: [
            {
                path: 'login',
                name: 'Login',
                component: Login
            },
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    base: 'admin',
    routes, // short for routes: routes
    linkExactActiveClass: 'nav-item active'
});

export default router
