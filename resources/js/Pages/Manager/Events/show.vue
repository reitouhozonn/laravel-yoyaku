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
    users: String,
})

</script>

<template>
    <AppLayout title="イベント作成">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                イベント詳細
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
                            <div class="flex space-x-6 justify-around">

                                <label class="flex items-center">
                                    <div v-if="event.is_visible">
                                        <span class="ml-2 text-sm text-gray-600">表示中</span>
                                    </div>
                                    <div v-else="event.is_visible">
                                        <span class="ml-2 text-sm text-gray-600">非表示中</span>
                                    </div>
                                </label>

                            </div>
                            <Link v-if="eventDate >= today" :href="route('events.edit', event.id)">
                            <JetButton class="ml-4">
                                編集する
                            </JetButton>
                            </Link>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="users[0]" class="bg-white py-8 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-2xl mt-4 mx-auto">
                        <p>予約状況</p>
                        {{ users }}
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
