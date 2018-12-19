<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100">
                <md-card>
                    <md-card-header data-background-color="orange">
                        <h4 class="title">Employees Stats</h4>
                        <p class="category">Last update on 15th September, 2016</p>
                    </md-card-header>
                    <md-card-content>
                        <ordered-table
                                table-header-color="green"
                                :items.sync="categories"
                                :table-fields="tableField"
                        />
                    </md-card-content>
                </md-card>

            </div>
        </div>
    </div>
</template>

<script>
    import {
        StatsCard,
        ChartCard,
        NavTabsCard,
        NavTabsTable,
        OrderedTable
    } from '@/components'

    export default {
        name: "categoriesList",
        components: {
            StatsCard,
            ChartCard,
            NavTabsCard,
            NavTabsTable,
            OrderedTable
        },
        data: () => ({
            categories: [],
            tableField: [
                {
                    name: 'Id',
                    key: 'id'
                },
                {
                    name: 'Name',
                    key: 'name',
                    order: true
                },
                {
                    name: 'Test',
                    key: 'test'
                },
                {
                    name: 'Test1',
                    key: 'test1'
                },
                {
                    name: 'Test2',
                    key: 'test2'
                }
            ]
        }),
        created() {
            this.getCategory();
        },
        methods: {
            getCategory() {
                this.$http.get('/categories')
                    .then(response => this.categories = response.data.data)
                    .catch(error => console.log(error))
            }
        }
    }
</script>

<style scoped>

</style>