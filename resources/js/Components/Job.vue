<script setup>
import { Link } from '@inertiajs/vue3';
import IconField from '@/Components/IconField.vue';

defineProps({
    job: Object,
});
</script>
<template>
    <Link
        :href="`/jobs/${job.id}`"
        class="flex flex-col divide-y divide-base-content/10 rounded-box border border-base-content/10 bg-base-100"
    >
        <div class="space-y-4 p-4">
            <h2 class="truncate text-2xl">
                {{ job.title }}
            </h2>
            <div class="space-y-4">
                <IconField icon="apartment">
                    {{ job.company.name }}
                </IconField>
                <IconField icon="pin_drop">
                    {{ job.company.street }}, {{ job.company.city }} -
                    {{ job.company.state }}
                </IconField>
                <IconField icon="payments">
                    {{ job.salary }}
                </IconField>
                <IconField icon="schedule">
                    {{ job.schedule }}
                </IconField>
                <IconField icon="home_work">
                    {{ job.model }}
                </IconField>
            </div>
        </div>

        <div class="flex-1 space-y-4 p-4">
            <h2 class="font-medium">ABOUT THE ROLE</h2>
            <p class="line-clamp-5 leading-8">
                {{ job.about }}
            </p>
        </div>

        <div class="space-x-4 truncate p-4">
            <span v-for="(tag, index) in job.tags" :key="index" class="text-sm">
                #{{ tag }}
            </span>
        </div>
    </Link>
</template>
