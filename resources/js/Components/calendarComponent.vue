<script setup>
import CalendarTime from './calendar-time.vue';
import CalendarDay from './calendar-day.vue';
import JetBanner from '@/Jetstream/Banner.vue';

</script>


<template>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font">
                    <JetBanner />
                    <div class="container px-5 py-8 mx-auto">

                        <div class="w-full mx-auto overflow-auto">
                            <div class="flex border border-green-400 mx-auto">
                                <CalendarTime />
                                <CalendarDay />
                            </div>
                        </div>
                        <div v-for="event in $page.props.events" :key="event.id">{{ event.start_date }}</div>
                    </div>
                </section>
            </div>
        </div>
    </div>

</template>
