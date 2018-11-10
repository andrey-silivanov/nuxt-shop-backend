<template>
    <div>
        <div class="md-layout-item md-small-size-100 md-size-33">

        </div>
        <div class="md-layout md-gutter md-alignment-top-right">
            <div class="md-layout-item md-size-33 md-small-size-50 md-xsmall-size-100">
                <md-field>
                    <label>Search...</label>
                    <md-input type="text" v-model="search" @input="searchOnTable"></md-input>
                </md-field>
            </div>
        </div>

        <md-table v-model="searched" md-sort="id" :table-header-color="tableHeaderColor">
            <md-table-empty-state
                    md-label="No users found"
                    :md-description="`No item found for this '${search}' query. Try a different search term.`">
            </md-table-empty-state>
            <md-table-row slot="md-table-row" slot-scope="{ item }">

                <md-table-cell v-for="field in tableFields"
                               :md-label="field.name"
                               :md-sort-by="field.key">
                    {{ item[field.key] }}
                </md-table-cell>

            </md-table-row>
        </md-table>
    </div>
</template>

<script>
    const toLower = text => {
        return text.toString().toLowerCase()
    };

    const search = (items, term,tableFields) => {

        if (term) {
            return items.filter(item => {
                let result = false;
                tableFields.forEach( value => {
                    if (!result) result = toLower(item[value.key]).includes(toLower(term))
                });

                return result;
            })
        }

        return items
    };

    export default {
        name: 'ordered-table',
        props: {
            tableHeaderColor: {
                type: String,
                default: ''
            },
            items: Array,
            tableFields: Array
        },
        data() {
            return {
                searched: [],
                search: '',
            }
        },
        methods: {
            searchOnTable() {
                this.searched = search(this.items, this.search, this.tableFields)
            }
        },
        created() {
            this.searched = this.items
        }
    }
</script>
<style>
    /* webkit solution */
    ::-webkit-input-placeholder { text-align:right; }
    /* mozilla solution */
    input:-moz-placeholder { text-align:right; }
</style>
