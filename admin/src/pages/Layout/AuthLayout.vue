<template>

    <div class="auth-layout" :data-image="backgroundImage" :style="sidebarStyle">
        <!--<div class="logo">
            <a href="#" class="simple-text logo-mini">
                <div class="logo-img">
                    <img :src="imgLogo" alt="">
                </div>
            </a>

            <a href="https://www.creative-tim.com/product/vue-material-dashboard" target="_blank" class="simple-text logo-normal">
                {{title}}
            </a>
        </div>-->
        <div class="auth-wrapper md-layout md-gutter md-alignment-center-center">
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>

</template>
<script>
    export default{
        props: {
            backgroundImage: {
                type: String,
                default: require('@/assets/img/sidebar-3.jpg')
            },
            imgLogo: {
                type: String,
                default: require('@/assets/img/vue-logo.png')
            },
            activeColor: {
                type: String,
                default: 'green',
                validator: (value) => {
                    let acceptedValues = ['', 'purple', 'blue', 'green', 'orange', 'red']
                    return acceptedValues.indexOf(value) !== -1
                }
            },
        },
        computed: {
            sidebarStyle () {
                return {
                    backgroundImage: `url(${this.backgroundImage})`
                }
            }
        }
    }
</script>
<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .1s
    }

    .fade-enter,
    .fade-leave-to
        /* .fade-leave-active in <2.1.8 */

    {
        opacity: 0
    }
</style>
