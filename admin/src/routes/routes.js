import DashboardLayout from '@/pages/Layout/DashboardLayout.vue'
import AuthLayout from '@/pages/Layout/AuthLayout.vue'

import Dashboard from '@/pages/Dashboard.vue'
import UserProfile from '@/pages/UserProfile.vue'
import Login from '@/pages/Login'

const routes = [
    {
        path: '/',
        component: DashboardLayout,
        redirect: '/dashboard',
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
]

export default routes
