<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import JetLabel from '@/Jetstream/Label.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';


const props = defineProps({
    event: Object,
    reservation: Object,
    eventDate: String,
    startTime: String,
    endTime: String,
    today: String,
})

const form = useForm({
    number_of_people: props.reservation.number_of_people,
})

const submit = () => {
    form.post(route('mypage.cancel', props.event.id))
}


</script>

<template>
    <AppLayout title="イベント作成">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                予約したイベント詳細
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white py-8 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-2xl mt-4 mx-auto">
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
                        <form @submit.prevent="submit">
                            <div class="md:flex justify-between items-end">
                                <div class="mt-4">
                                    <JetLabel for="" value="予約人数" />
                                    {{ reservation.number_of_people }}
                                </div>
                                <JetButton v-if="eventDate >= today" class="ml-4"
                                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    キャンセルする
                                </JetButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
