<template>
    <div>
        <div id="example-3" class="demo">
            <input type="checkbox" id="jack" value="Джек" v-model="checkedNames" @change="handleCheckBox">
            <label for="jack">Джек</label>
            <input type="checkbox" id="john" value="Джон" v-model="checkedNames" @change="handleCheckBox">
            <label for="john">Джон</label>
            <input type="checkbox" id="mike" value="Майк" v-model="checkedNames" @change="handleCheckBox">
            <label for="mike">Майк</label>
            <br>
            <span>Отмеченные имена: {{ checkedNames }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "model-checkbox",
        props: ['value'],
        data() {
            return {
                checkedNames: this.value,
                i: 0,
            }
        },
        methods: {
            handleCheckBox(e) {
                this.$emit('input', this.checkedNames)
            }
        }
    }
</script>

<style scoped>

</style>