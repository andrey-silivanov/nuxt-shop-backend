<template>
    <div class="content">
        <h1>Input {{ input }}</h1>
        <input-model v-model="input">
            <h5 slot="header">New slots2</h5>
            <slot>sdfsfsdsd5555</slot>
        </input-model>

        <h1>Checkbox: {{ checkedNames }}</h1>
        <checkbox-model v-model.lazy="checkedNames"></checkbox-model>

        <h1>Selected: {{ selected }}</h1>
        <select-model v-model="selected"></select-model>

        <hr>
        <hr>
        <hr>
        <button @click="componentName = 'input-model'">Input</button>
        <button @click="componentName = 'checkbox-model'; test = []">Checkbox</button>
        <button @click="componentName = 'select-model'">Select</button>
        <h1>Value: {{ test }}</h1>

        <components :is="componentName" v-model="test"></components>
    </div>

</template>

<script>
    import InputModel from '@/components/model-input'
    import CheckboxModel from '@/components/model-checkbox'
    import SelectModel from '@/components/model-select'

    export default {
        name: "Index",
        data() {
            return {
                test: '',
                input: '',
                checkedNames: [],
                selected: '',
                componentName: 'input-model',
                componentManes: [
                    'input-model',
                    'checkbox-model',
                    'select-model',
                ]
            }
        },
        components: {
            InputModel,
            CheckboxModel,
            SelectModel
        }
    }
</script>

<style scoped>

</style>