<template>
    <div><full-calendar :events="fcEvents" locale="en"></full-calendar></div>
</template>

<script>
    import fullCalendar from 'vue-fullcalendar';

    export default {
        name: "Index",
        data () {
            return {
                fcEvents : [
                    {
                        title : 'Sunny Out of Office',
                        start : '2019-02-25',
                        end : '2019-02-27'
                    }
                ]
            }
        },
        components: {
            fullCalendar
        }
    }
</script>

<style scoped>

</style>