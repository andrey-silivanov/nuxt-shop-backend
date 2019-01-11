<template>
    <div class="content">
        <div class="md-layout filter-products">
            <div class="md-layout-item">
                <autocomplete
                        :items="parentCategories"
                        :placeholder="'Parent categories'"
                        @selected="selectedParentCategory"
                >
                </autocomplete>
            </div>
            <div class="md-layout-item">
                <autocomplete
                        :items="categories"
                        :placeholder="'Categories'"
                        @selected="selectedCategory"
                >
                </autocomplete>
            </div>
            <div class="md-layout-item">
                <autocomplete
                        :items="products"
                        :placeholder="'Search'"
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
            parentCategories: [],
            categories: [],
            pagination: {
                total: 0
            },
            queryParams: {
                page: 1,
                categoryId: '',
                search: ''
            }
        }),
        created() {
            this.getProducts();
            this.getCategory();
        },
        methods: {
            getProducts(page = 1) {
                this.$http.get(`/products`, {
                    params: this.queryParams
                })
                    .then(response => {
                        this.pagination.total = response.data.paginate.meta.last_page;
                        this.products = response.data.data
                    })
                    .catch(error => console.log(error))
            },
            getCategory() {
                this.$http.get('/categories/parent')
                    .then(response => this.parentCategories = response.data.data)
                    .catch(error => console.log(error))
            },
            selectedParentCategory(value) {
                this.$http.get(`/categories/children/${value.id}`)
                    .then(response => {
                        this.categories = response.data.data;
                        this.queryParams.categoryId = value.id;
                        this.getProducts();
                    })
                    .catch(error => console.log(error))
            },
            selectedCategory(value) {
                this.queryParams.categoryId = value.id;
                this.getProducts();
            },
            searchProducts(value) {
                if (value.length % 2) {
                    this.queryParams.search = value;
                    this.getProducts()
                }
            }
        }
    }
</script>
