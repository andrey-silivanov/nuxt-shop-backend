<template>
    <div class="wrapper" :class="{'nav-open': $sidebar.showSidebar}">
        <notifications></notifications>

        <side-bar>
            <mobile-menu slot="content"></mobile-menu>
            <sidebar-link to="/dashboard">
                <md-icon>dashboard</md-icon>
                <p>Dashboard</p>
            </sidebar-link>
            <sidebar-link to="/user">
                <md-icon>person</md-icon>
                <p>User Profile</p>
            </sidebar-link>
            <sidebar-link to="/products">
                <md-icon>person</md-icon>
                <p>Products</p>
            </sidebar-link>
            <sidebar-link to="/categories">
                <md-icon>person</md-icon>
                <p>Categories</p>
            </sidebar-link>
        </side-bar>

        <div class="main-panel">
            <top-navbar></top-navbar>

            <dashboard-content>

            </dashboard-content>

            <content-footer v-if="!$route.meta.hideFooter"></content-footer>
        </div>
    </div>
</template>
<style lang="scss">

</style>
<script>
    import TopNavbar from './TopNavbar.vue'
    import ContentFooter from './ContentFooter.vue'
    import DashboardContent from './Content.vue'
    import MobileMenu from '@/pages/Layout/MobileMenu.vue'

    export default {
        components: {
            TopNavbar,
            DashboardContent,
            ContentFooter,
            MobileMenu
        },
        mounted() {
            Echo.private(`App.Models.User.${this.$auth.user().id}`)
                .notification((notification) => {
                    console.log(notification);
                    this.pushInArray(notification)
                });
        },
    }
</script>
