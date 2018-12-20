<template>
    <md-autocomplete
            v-model="selectedItem"
            :md-options="items"
            @md-opened="opened"
            @md-selected="selected"
            @md-changed="changed"
            md-dense>
        <label>{{ placeholder }}</label>
        <template slot="md-autocomplete-item" slot-scope="{ item }">{{ item.name }}</template>
    </md-autocomplete>
</template>

<script>
    export default {
        name: "Autocomplete",
        data: () => ({
            selectedItem: ''
        }),
        props: {
            items: Array,
            placeholder: String
        },
        methods: {
            opened() {
                this.selectedItem += " ";
                this.selectedItem = this.selectedItem.substring(0, this.selectedItem.length - 1)
            },
            selected (item) {
                console.log('che')
                this.selectedItem = item.name
                this.$emit('selected', item)
            },
            changed(value) {
                this.$emit('changed', value)
            }
        }
    }
</script>

<style scoped>

</style>