<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Button from '../../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Button.vue';
import { Link } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Jetstream/Banner.vue';


defineProps({
    events: Object,
    status: String,
})
</script>

<template>
    <AppLayout title="イベント管理">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                過去のイベント一覧
            </h2>
        </template>


        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- <Welcome /> -->
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">

                            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                {{ status }}
                            </div>
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
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                定員</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                表示</th>
                                            <!-- <th
                                                class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            </th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="event in events.data" :key="event.id">
                                            <td class="text-blue-500 px-4 py-3">
                                                <Link :href="route('events.show', event.id)">
                                                {{ event.name }}
                                                </Link>
                                            </td>
                                            <td class="px-4 py-3">{{ event.start_date }}</td>
                                            <td class="px-4 py-3">{{ event.end_date }}</td>
                                            <td v-if="event.number_of_people == null" class="px-4 py-3">0</td>
                                            <td v-else class="px-4 py-3">{{ event.number_of_people }}</td>
                                            <td class="px-4 py-3">{{ event.max_people }}</td>
                                            <td v-if="event.is_visible === 1"
                                                class="px-4 py-3 bg-green-300 rounded-full">
                                                表示中</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination class="mt-6" :links="events.links" />
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
