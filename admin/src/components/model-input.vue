<template>
    <div>
        <h2>component</h2>
        <slot> Component slot </slot>
        <input type="text" v-model="content" @input="handleInput">

    </div>
</template>

<script>
    export default {
        name: "model-input",
        props: ['value'],
        data() {
            return {
                content: this.value
            }
        },
        methods: {
            handleInput(e) {
                this.$emit('input', this.content)
            }
        }
    }
</script>

<style scoped>

</style>