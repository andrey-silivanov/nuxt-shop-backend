<template>
    <div class="content">
        <div class="md-layout filter-products">
            <div class="md-layout-item">
                <autocomplete
                        :items="categories"
                        :placeholder="'Categories'"
                        @selected="selectedCategory"
                >
                </autocomplete>
            </div>
            <div class="md-layout-item">
                <!--<md-autocomplete v-model="selectedCountry" :md-options="countries">
                    <label>Country</label>
                </md-autocomplete>-->
            </div>
            <div class="md-layout-item">
                <autocomplete
                        :items="products"
                        :placeholder="'Search'"
                        @selected="selectedCategory"
                        @changed="searchProducts"
                >
                </autocomplete>
            </div>

        </div>

        <div class="md-layout">
            <div v-for="product in products" class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-25">
                <md-card class="product-card">
                    <md-card-header data-background-color="white">
                        <md-card-header-text>
                            <div class="md-title product-name">{{ product.name }}</div>
                           <!-- <div class="md-subhead">{{ product.description }}</div>-->
                        </md-card-header-text>

                        <md-card-media>
                            <img :src="product.picture" alt="People">
                        </md-card-media>
                    </md-card-header>
                    <md-card-content >
                        <p>{{ product.sizes }}</p>
                        <p>{{ product.color }}</p>
                    </md-card-content>

                    <md-card-actions>
                        <md-button>Action</md-button>
                        <md-button>Action</md-button>
                    </md-card-actions>
                </md-card>
            </div>
        </div>
        <div class="md-layout md-alignment-center-center">
            <paginate
                    :page-count="pagination.total"
                    :click-handler="getProducts"
                    :prev-text="'Prev'"
                    :next-text="'Next'"
                    :container-class="'pagination'">
            </paginate>
        </div>
    </div>
</template>

<script>
    export default {
        name: "productsList",
        data: () => ({
            products: [],
            categories: [],
            search: '',
            pagination: {
                total: 0
            },
        }),
        created() {
            this.getProducts();
            this.getCategory();
        },
        methods: {
            getProducts(page = 1) {
                console.log(page);
                this.$http.get(`/products?page=${page}`)
                    .then(response => {
                        this.pagination.total = response.data.paginate.meta.last_page;
                        this.products = response.data.data
                    })
                    .catch(error => console.log(error))
            },
            getCategory() {
                this.$http.get('/categories')
                    .then(response => this.categories = response.data.data)
                    .catch(error => console.log(error))
            },
            selectedCategory(value) {
                console.log('sel');
                console.log(value)
            },
            searchProducts(value) {
                console.log(value)
            }
        }
    }
</script>
