import Vue from 'vue';
import VueRouter from "vue-router";

import DashboardLayout from '@/pages/Layout/DashboardLayout.vue'
import AuthLayout from '@/pages/Layout/AuthLayout.vue'

import Dashboard from '@/pages/Dashboard.vue'
import UserProfile from '@/pages/UserProfile.vue'
import Login from '@/pages/Auth/Login'
import CategoriesList from '@/pages/Categories/List'
import ProductsList from '@/pages/Products/List'
import NotFound from '@/pages/Errors/NotFound'
import Forbidden from '@/pages/Errors/Forbidden'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: DashboardLayout,
        redirect: '/dashboard',
        meta: {
            auth: {
                roles: 'admin',
            },
        },
        children: [
            {
                path: 'dashboard',
                name: 'Dashboard',
                component: Dashboard,
            },
            {
                path: 'user',
                name: 'User Profile',
                component: UserProfile
            },
            {
                path: 'categories',
                name: 'Categories',
                component: CategoriesList
            },
            {
                path: 'products',
                name: 'Products',
                component: ProductsList
            }
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
                component: Login,
                meta: {
                    auth: false
                }
            },
        ]
    },
    {
        path: '/403',
        name: '403',
        component: Forbidden,
    },
    {
        path: '/404',
        name: '404',
        component: NotFound,
    },
    {
        path: '*',
        redirect: '/404'
    }
];

const router = new VueRouter({
    mode: 'history',
    base: 'admin',
    routes, // short for routes: routes
    linkExactActiveClass: 'nav-item active'
});

export default router
