<template>
    <h1>ff3f</h1>
</template>

<script>
    export default {
        name: "ProductsShow",
        data: () => ({
            product: {}
        }),
        created() {
            this.getProduct()
        },
        methods: {
            getProduct() {
                this.$http.get(`/products/${this.$route.params.id}`)
                    .then(response => {
                        this.product = response.data.data
                    })
                    .catch(error => console.log(error))
            }
        }
    }
</script>

<style scoped>

</style>