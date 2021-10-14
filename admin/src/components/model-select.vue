<template>
    <div>
        <select v-model="selected" @change="handleInput">
            <option disabled value="">Выберите один из вариантов</option>
            <option>А</option>
            <option>Б</option>
            <option>В</option>
        </select>
        <span>Выбрано: {{ selected }}</span>
    </div>
</template>

<script>
    export default {
        name: "model-select",
        props: ['value'],
        data() {
            return {
                selected: this.value
            }
        },
        methods: {
            handleInput(e) {
                this.$emit('input', this.selected)
            }
        }
    }
</script>

<style scoped>

</style>