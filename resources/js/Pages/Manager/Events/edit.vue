<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import { useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import route from '../../../../../vendor/tightenco/ziggy/src/js';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import Textara from '../../../Components/textara.vue';
import JetBanner from '@/Jetstream/Banner.vue';


const props = defineProps({
    event: Object,
    eventDate: String,
    startTime: String,
    endTime: String,
})


const form = useForm({
    event_name: props.event.name,
    information: props.event.information,
    event_date: props.eventDate,
    start_time: props.startTime,
    end_time: props.endTime,
    max_people: props.event.max_people,
    is_visible: props.event.is_visible,
});

const submit = () => {
    form.put(route('events.update', props.event.id))
};
</script>

<template>
    <AppLayout title="イベント作成">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                イベント作成
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
                                <JetInput id="event_name" v-model="form.event_name" type="text"
                                    class="mt-1 block w-full" required />
                                {{ event.name }}
                            </div>
                            <div class="mt-4">
                                <JetLabel for="information" value="イベント詳細" />
                                <Textara rows="3" id="information" v-model="form.information" type="text"
                                    class="mt-1 block w-full" />
                            </div>

                            <div class="md:flex justify-between">
                                <div class="mt-4">
                                    <JetLabel for="event_date" value="イベント日付" />
                                    <JetInput id="event_date" v-model="form.event_date" type="text"
                                        class="mt-1 block w-full" />
                                </div>

                                <div class="mt-4">
                                    <JetLabel for="start_time" value="開始時間" />
                                    <JetInput id="start_time" v-model="form.start_time" type="text"
                                        class="mt-1 block w-full" />
                                </div>

                                <div class="mt-4">
                                    <JetLabel for="end_time" value="終了時間" />
                                    <JetInput id="end_time" v-model="form.end_time" type="text"
                                        class="mt-1 block w-full" />
                                </div>
                            </div>
                            <div class="md:flex justify-between items-end">
                                <div class="mt-4">
                                    <JetLabel for="max_people" value="定員数" />
                                    <JetInput id="max_people" v-model="form.max_people" type="number"
                                        class="mt-1 block w-full" />
                                </div>
                                <div class="flex space-x-6 justify-around">

                                    <label class="flex items-center">
                                        <JetCheckbox v-model:checked="form.is_visible" name="表示" />
                                        <span class="ml-2 text-sm text-gray-600">表示する</span>
                                    </label>

                                </div>
                                <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    更新する
                                </JetButton>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
