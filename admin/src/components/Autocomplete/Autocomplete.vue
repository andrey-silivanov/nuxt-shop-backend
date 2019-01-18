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
            placeholder: String,
            value: {
                default: ''
            }
        },
        watch: {
            value(v) {
                if (v.hasOwnProperty('name')) {
                    this.selectedItem  = v.name;
                }
            }
        },
        methods: {
            opened() {
                this.selectedItem += " ";
                this.selectedItem = this.selectedItem.substring(0, this.selectedItem.length - 1)
            },
            selected (item) {
                this.selectedItem = item.name;
                this.$emit('selected', item)
            },
            changed(value) {
                if(value === '') this.$emit('selected', {});
                this.$emit('changed', value)
            }
        }
    }
</script>

<style scoped>

</style>