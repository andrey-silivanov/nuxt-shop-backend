<template>
   <div class="content">
       <calendar></calendar>
   </div>
</template>

<script>
    import Calendar from '@/components/Calendar/SimpleCalendar.vue'

    export default {
        name: "index",
        components: {
            Calendar
        }
    }
</script>

<style scoped>

</style>