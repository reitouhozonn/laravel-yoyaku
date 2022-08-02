<script setup>
defineProps({
    events: Array
})
</script>

<template>
    <div v-for="today in $page.props.currentWeek" :key="today.checkDate" class="w-32">
        <div class="py-1 px2 border border-gray-200 text-center">{{ today.day }}</div>
        <div class="py-1 px2 border border-gray-200 text-center">{{ today.dayOfWeek }}</div>
        <div v-for="(time, index) in $page.props.eventTime" :key="index">
            <div v-if="$page.props.events" class="py-1 px2 h-8 border border-gray-200 text-center">
                <div v-for="event in $page.props.events">
                    <div v-if="today.checkDate + ' ' + time == event.start_date" class="text-xs bg-blue-200">
                        {{ event.name }}</div>
                </div>
            </div>
            <div v-else class="py-1 px2 h-8 border border-gray-200 text-center"></div>
        </div>
    </div>
</template>
