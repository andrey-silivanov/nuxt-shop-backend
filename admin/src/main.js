// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App'

// router setup
import router from './routes/routes'

// Plugins
import GlobalComponents from './globalComponents'
import GlobalDirectives from './globalDirectives'
import Notifications from './components/NotificationPlugin/index'

// MaterialDashboard plugin
import MaterialDashboard from './material-dashboard'

import Chartist from 'chartist'
import axios from 'axios';
import VueAxios from 'vue-axios';

const domain = 'http://nuxt-shop-back';

Vue.use(VueAxios, axios);
Vue.axios.defaults.baseURL = `${domain}/api/admin`;

Vue.axios.interceptors.response.use(response => response,
    (error) => {
        if (error.response.status === 403 && !error.response.config.url.includes('user/login')) {
            Vue.auth.logout({
                success() {
                    window.localStorage.removeItem('userData');
                },
                redirect: '/login',
            });
        }
        if(error.response.status === 404) {
            Vue.router.push({ name: '404'})
        }
        return Promise.reject(error);
    });

Vue.router = router;

Vue.use(require('@websanova/vue-auth'), {
    auth: {
        request: function (req, token) {
            this.options.http._setHeaders.call(this, req, {Authorization: 'Bearer ' + token});
        },

        response: function (res) {
            let token = res.data.access_token;

            if (token) {
                token = token.split(/Bearer\:?\s?/i);

                return token[token.length > 1 ? 1 : 0].trim();
            }
        }
    },
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    authRedirect: '/auth/login',
    parseUserData: function (response) {
        return response.data
    },
    forbiddenRedirect: {path: '/403'},
    rolesVar: 'role'
})


Vue.use(MaterialDashboard);
Vue.use(GlobalComponents);
Vue.use(GlobalDirectives);
Vue.use(Notifications);

import VueLazyLoad from 'vue-lazyload'

Vue.use(VueLazyLoad);

// global library setup
Object.defineProperty(Vue.prototype, '$Chartist', {
    get() {
        return this.$root.Chartist
    }
});

/* eslint-disable no-new */
new Vue({
    el: '#app',
    render: h => h(App),
    router,
    data: {
        Chartist: Chartist
    }
})

import Echo from 'laravel-echo'
window.io = require('socket.io-client');

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: `${domain}:6001`,
});
