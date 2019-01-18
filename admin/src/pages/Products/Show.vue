<template>
    <div class="content">
        <div class="md-layout md-alignment-center-center">
            <div class="md-layout-item md-medium-size-100 md-size-60 ">
                <md-card class="md-card-profile">
                    <div class="md-card-avatar product-preview" @click="index = 0">
                        <img class="img" :src="product.picture">
                    </div>
                    <md-card-content>
                        <h6 class="category text-gray">{{ product.title }}</h6>
                        <h4 class="card-title">{{ product.name }}</h4>
                        <p class="card-description">
                          {{ product.description }}
                        </p>
                        <div class="md-layout md-gutter">
                        <div class="md-layout-item md-small-size-100">
                            <md-list>
                                <md-list-item>
                                    <strong>SKU:</strong>  {{ product.sku }}
                                </md-list-item>
                                <md-list-item>
                                    <strong>Brand:</strong>  {{ product.brand }}
                                </md-list-item>
                                <md-list-item>
                                    <strong>Phone model:</strong>  {{ product.phoneModel }}
                                </md-list-item>
                                <md-list-item>
                                    <strong>Price:</strong>  {{ product.price }}
                                </md-list-item>
                            </md-list>

                        </div>
                        <div class="md-layout-item md-small-size-100">
                            <md-list>
                                <md-list-item>
                                    <strong>Color:</strong>  {{ product.color }}
                                </md-list-item>
                                <md-list-item>
                                    <strong>Category:</strong>  {{ product.category }}
                                </md-list-item>
                                <md-list-item>
                                    <strong>Material:</strong>  {{ product.material }}
                                </md-list-item>
                                <md-list-item>
                                    <strong>Show:</strong>
                                    <md-icon v-if="product.show" class="text-success">done_outline</md-icon>
                                    <md-icon v-else class="text-danger">clear</md-icon>
                                </md-list-item>
                            </md-list>
                        </div>
                        </div>
                        <md-button class="md-round md-success">Edit</md-button>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <vue-gallery :images="images" :index="index" @close="index = null"></vue-gallery>
    </div>
</template>

<script>

    import VueGallery from 'vue-gallery';

    export default {
        components: {
            VueGallery,
        },
        name: "ProductsShow",
        data: () => ({
            product: {},
            index: null,
            images: []
        }),
        created() {
            this.getProduct()
        },
        methods: {
            getProduct() {
                this.$http.get(`/products/${this.$route.params.id}`)
                    .then(response => {
                        this.product = response.data.data;
                        this.images.push(this.product.picture);
                    }, error => {
                        if(error.response.status === 500) {
                            this.$notify({
                                message:
                                    `<b>${error.response.statusText}</b> <p>${error.response.data.message}</p>`,
                                icon: "add_alert",
                                horizontalAlign: 'center',
                                verticalAlign: 'top',
                                type: 'danger',
                            });
                        }
                    })
                    .catch(error => console.log(error))
            },
            openGallery(index) {
                this.$refs.lightbox.showImage(index)
            }
        }
    }
</script>

<style scoped>
    .product-preview {
        cursor: pointer;
    }
</style>