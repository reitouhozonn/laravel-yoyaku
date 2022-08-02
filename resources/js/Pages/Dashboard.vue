<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import CalendarComponent from '../Components/calendarComponent.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                イベントカレンダー
            </h2>
        </template>

        <CalendarComponent />
    </AppLayout>
</template>
