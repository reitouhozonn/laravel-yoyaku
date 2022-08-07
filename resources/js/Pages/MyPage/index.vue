<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Jetstream/Banner.vue';


defineProps({
    fromTodayEvents: Object,
    pastEvents: Object,
})
</script>

<template>
    <AppLayout title="イベント管理">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                予約済みのイベント
            </h2>
        </template>


        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <JetBanner />
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                イベント名</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                開始日時</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                終了日時</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                予約人数</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="event in fromTodayEvents" :key="event.id">
                                            <td class="text-blue-500 px-4 py-3">
                                                <Link :href="route('mypage.show', event.id)">
                                                {{ event.name }}
                                                </Link>
                                            </td>
                                            <td class="px-4 py-3">{{ event.start_date }}</td>
                                            <td class="px-4 py-3">{{ event.end_date }}</td>
                                            <td class="px-4 py-3">{{ event.number_of_people }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <pagination class="mt-6" :links="events.links" /> -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- 過去のイベント -->
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h2 class="text-center pt-4">過去のイベント</h2>
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                イベント名</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                開始日時</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                終了日時</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                予約人数</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="event in pastEvents" :key="event.id">
                                            <td class="text-blue-500 px-4 py-3">
                                                <Link :href="route('mypage.show', event.id)">
                                                {{ event.name }}
                                                </Link>
                                            </td>
                                            <td class="px-4 py-3">{{ event.start_date }}</td>
                                            <td class="px-4 py-3">{{ event.end_date }}</td>
                                            <td class="px-4 py-3">{{ event.number_of_people }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <pagination class="mt-6" :links="events.links" /> -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
