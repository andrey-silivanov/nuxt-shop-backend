<template>
    <div class="content">
        <div class="md-layout filter-products">
            <div class="md-layout-item">
                <autocomplete
                        :items="brands"
                        :placeholder="'Brand'"
                        @selected="selectedBrand"
                        :value="currentBrand"
                >
                </autocomplete>
            </div>
            <div class="md-layout-item">
                <autocomplete
                        :items="phoneModels"
                        :placeholder="'Phone model'"
                        @selected="selectedPhoneModel"
                        :value="currentPhoneModel"
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
                        @selected="searchProducts"
                >
                </autocomplete>
            </div>

        </div>

        <div class="md-layout">
            <div v-for="product in products" class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-25">
                <md-card class="product-card">
                    <router-link :to="{ name: 'Products Show', params: { id: product.id }}">
                    <md-card-header data-background-color="white">
                        <md-card-header-text>
                            <div class="md-title product-name">{{ product.name }}</div>
                           <!-- <div class="md-subhead">{{ product.description }}</div>-->
                        </md-card-header-text>

                        <md-card-media>
                            <img :src="product.picture" alt="People">
                        </md-card-media>
                    </md-card-header>
                    </router-link>
                    <md-card-content >
                        <p><strong>Price: </strong>{{ product.price }}</p>
                        <p><strong>Color: </strong>{{ product.color }}</p>
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
            brands: [],
            phoneModels: [],
            categories: [],
            currentBrand: {},
            currentPhoneModel: {},
            pagination: {
                total: 0
            },
            queryParams: {
                page: 1,
                categoryId: '',
                phoneModelId: '',
                search: ''
            }
        }),
        created() {
           // this.getProducts();
            this.getBrands();
            //this.getPhoneModels();
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
                this.$http.get('/categories')
                    .then(response => this.categories = response.data.data)
                    .catch(error => console.log(error))
            },
            selectedCategory(value) {
                console.log('cat');
                console.log(value);
                this.queryParams.categoryId = value.id;
                this.getProducts();
            },
            searchProducts(value) {
                if (value.length % 2 || value.length === 0) {
                    this.queryParams.search = value;
                    this.getProducts()
                }
            },
            getBrands() {
                this.$http.get(`/brands`)
                    .then(response => {
                        this.brands = response.data.data;
                        if(this.brands.length > 0) this.currentBrand = this.brands[0];
                        this.getPhoneModels();
                    })
                    .catch(error => console.log(error))
            },
            getPhoneModels() {
                this.$http.get(`/phone-models`, {params: {brandId: this.currentBrand.id}})
                    .then(response => {
                        this.phoneModels = response.data.data;
                        if(this.brands.length > 0) {
                            this.currentPhoneModel = this.phoneModels[0]
                            this.queryParams.phoneModelId = this.currentPhoneModel.id
                        }
                        this.getProducts()
                    })
                    .catch(error => console.log(error))
            },
            selectedBrand(value) {
                this.currentBrand = value;
                this.getPhoneModels()
            },
            selectedPhoneModel(value) {
                this.currentPhoneModel = value;
                this.queryParams.phoneModelId = this.currentPhoneModel.id;
                this.getProducts();
            }
        }
    }
</script>
