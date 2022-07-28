<script setup>
defineProps({
    currentWeek: Array,
    events: ''
})

const j = 21
</script>

<template>
    <div class="w-32" v-for="today in currentWeek" :key="today.dayOfWeek">
        <div class="py-1 px2 border border-gray-200 text-center">{{ today.day }}</div>
        <div class="py-1 px2 border border-gray-200 text-center">{{ today.dayOfWeek }}</div>
        <div v-for="i in j">
            <div v-if="events" class="py-1 px2 h-8 border border-gray-200 text-center">1</div>
            <div v-else class="py-1 px2 h-8 border border-gray-200 text-center"></div>
        </div>
    </div>
</template>
