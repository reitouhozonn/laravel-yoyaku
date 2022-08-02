<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import JetButton from '@/Jetstream/Button.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import { Link } from '@inertiajs/inertia-vue3';



defineProps({
    event: Object,
    eventDate: String,
    startTime: String,
    endTime: String,
    today: String,
    users: Object,
})

</script>

<template>
    <AppLayout title="イベント作成">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                eventdetail
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white py-8 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-2xl mt-4 mx-auto">
                        <JetValidationErrors class="mb-4" />
                        <JetBanner />

                        <div>
                            <JetLabel for="event_name" value="イベント名" />
                            {{ event.name }}
                        </div>
                        <div class="mt-4">
                            <JetLabel for="information" value="イベント詳細" />
                            <p style="white-space: pre-wrap;">
                                {{ event.information }}
                            </p>
                        </div>

                        <div class="md:flex justify-between">
                            <div class="mt-4">
                                <JetLabel for="event_date" value="イベント日付" />
                                {{ eventDate }}
                            </div>

                            <div class="mt-4">
                                <JetLabel for="start_time" value="開始時間" />
                                {{ startTime }}
                            </div>

                            <div class="mt-4">
                                <JetLabel for="end_time" value="終了時間" />
                                {{ endTime }}
                            </div>
                        </div>
                        <div class="md:flex justify-between items-end">
                            <div class="mt-4">
                                <JetLabel for="max_people" value="定員数" />
                                {{ event.max_people }}
                            </div>
                            <JetButton class="ml-4">
                                予約する
                            </JetButton>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- {{ eventDate }} -->

        <!-- <div class="pb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="users[0]" class="bg-white py-4 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-2xl mt-4 mx-auto">
                        <div class="text-center pb-2">予約状況</div>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        予約者名</th>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        予約人数</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <td class="px-4 py-3">{{ user.name }}</td>
                                    <td class="px-4 py-3">{{ user.number_of_people }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </AppLayout>
</template>
