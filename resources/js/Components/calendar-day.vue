<script setup>
defineProps({
    events: Array
})
</script>

<template>
    <div class="w-32" v-for="today in $page.props.currentWeek" :key="today.checkDate">
        <div class="py-1 px2 border border-gray-200 text-center">{{ today.day }}</div>
        <div class="py-1 px2 border border-gray-200 text-center">{{ today.dayOfWeek }}</div>
        <div v-for="(time, index) in $page.props.eventTime" :key="index">
            <div v-if="$page.props.events" class="py-1 px2 h-8 border border-gray-200 text-center">{{ time }}</div>
            <div v-else class="py-1 px2 h-8 border border-gray-200 text-center"></div>
        </div>
    </div>
</template>
