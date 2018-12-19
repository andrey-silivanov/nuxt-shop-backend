<template>
    <div class="content">
        <div class="md-layout">

            <div v-for="product in products" class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-25">
                <md-card class="product-card">
                    <md-card-header data-background-color="white">
                        <md-card-header-text>
                            <div class="md-title">{{ product.name }}</div>
                           <!-- <div class="md-subhead">{{ product.description }}</div>-->
                        </md-card-header-text>

                        <md-card-media>
                            <img :src="product.picture" alt="People">
                        </md-card-media>
                    </md-card-header>
                    <md-card-content >
                        <span>{{ product.sizes }}</span>
                        <span>{{ product.color }}</span>
                    </md-card-content>

                    <md-card-actions>
                        <md-button>Action</md-button>
                        <md-button>Action</md-button>
                    </md-card-actions>
                </md-card>


                <!--<md-card>
                    <md-card-media>
                        <img :src="product.picture" alt="People">
                    </md-card-media>

                    <md-card-header>
                        <div class="md-title">{{ product.name }}</div>
                        <div class="md-subhead">{{ product.description }}</div>
                    </md-card-header>

                    <md-card-expand>
                        <md-card-actions md-alignment="space-between">
                            <div>
                                <md-button>Action</md-button>
                                <md-button>Action</md-button>
                            </div>

                            <md-card-expand-trigger>
                                <md-button class="md-icon-button">
                                    <md-icon>keyboard_arrow_down</md-icon>
                                </md-button>
                            </md-card-expand-trigger>
                        </md-card-actions>

                        <md-card-expand-content>
                            <md-card-content>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio itaque ea, nostrum odio. Dolores, sed accusantium quasi non, voluptas eius illo quas, saepe voluptate pariatur in deleniti minus sint. Excepturi.
                            </md-card-content>
                        </md-card-expand-content>
                    </md-card-expand>
                </md-card>-->

                <!--                <md-card>

                    <md-card-header class="card-chart product-cart" :style="{ backgroundImage: `url('${product.picture}')` }">

                    </md-card-header>

                    <md-card-content>
                        {{ product.name }}
                    </md-card-content>

                    <md-card-actions md-alignment="left">
                        footer
                    </md-card-actions>
                </md-card>-->
             <!--   <chart-card
                        :chart-data="dailySalesChart.data"
                        :chart-options="dailySalesChart.options"
                        :chart-type="'Line'"
                        data-background-color="blue">
                    <template slot="content">
                        <h4 class="title">Daily Sales</h4>
                        <p class="category">
                            <span class="text-success"><i class="fas fa-long-arrow-alt-up"></i> 55% </span> increase in today sales.
                        </p>
                    </template>

                    <template slot="footer">
                        <div class="stats">
                            <md-icon>access_time</md-icon>
                            updated 4 minutes ago
                        </div>
                    </template>
                </chart-card>-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "productsList",
        data: () => ({
            products: []
        }),
        created() {
            this.getProducts()
        },
        methods: {
            getProducts() {
                this.$http.get('/products')
                    .then(response => this.products = response.data.data)
                    .catch(error => console.log('er'))
            }
        }
    }
</script>

<style scoped>
    .product-cart {
        background-size: cover;
    }
</style>