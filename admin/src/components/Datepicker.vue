<template>
    <vue-datepicker v-model="date" format="YYYY-MM-DD H:i:s" width="100%" @input="handleDate"/>
</template>

<script>
    import VueDatepicker from 'vuejs-datetimepicker'

    export default {
        name: "Datepicker",
        props: ['value'],
        data() {
            return {
                date: this.value
            }
        },
        components: {
            VueDatepicker
        },
        methods: {
            handleDate() {
                this.$emit('input', this.date)
            }
        }
    }
</script>

<style >
    #tj-datetime-input {
        border: none;
    }
    .calender-div {
     z-index: 9;
    }
</style>