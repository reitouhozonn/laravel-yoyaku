<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';


import JetButton from '@/Jetstream/Button.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import route from '../../../vendor/tightenco/ziggy/src/js/index.js';
import { useForm } from '@inertiajs/inertia-vue3';




const props = defineProps({
    isReserved: Object,
    event: Object,
    eventDate: String,
    startTime: String,
    endTime: String,
    reservablePeople: Number,
})

const form = useForm({
    reserved_people: props.reservablePeople,
})

const submit = () => {
    form.post(route('events.reserve', props.event.id))
}

</script>

<template>
    <AppLayout title="イベント作成">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Event Detail
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white py-8 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-2xl mt-4 mx-auto">
                        <JetValidationErrors class="mb-4" />
                        <JetBanner />
                        <form @submit.prevent="submit">
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
                                <div v-if="props.isReserved == null && reservablePeople !== 0" class="mt-4">
                                    <JetLabel for="reserved_people" value="予約できる人数" />
                                    <select id="reserved_people" v-model="form.reserved_people">
                                        <option v-for="i in reservablePeople">{{ i }}</option>
                                    </select>
                                    <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        予約する
                                    </JetButton>
                                </div>
                                <div v-if="isReserved !== null">
                                    <div class="text-red-500 text-xl">すでに予約しています。</div>
                                </div>
                                <div v-if="reservablePeople == 0">
                                    <div class="text-red-500 text-xl">このイベントは満員です</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
