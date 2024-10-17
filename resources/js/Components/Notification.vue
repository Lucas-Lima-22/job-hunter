<script setup>
import { ref, onMounted } from 'vue';

defineProps({
    type: String,
    content: String,
});

const visible = ref(true);

onMounted(() => {
    setTimeout(() => {
        visible.value = false;
    }, 5000);
});
</script>
<template>
    <div v-if="visible" class="fixed bottom-4 right-4">
        <div
            v-if="type === 'info'"
            class="flex gap-4 rounded-xl bg-info/30 p-4 shadow-lg backdrop-blur md:p-8"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-12 shrink-0 stroke-info"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            <div class="text-info-content">
                <h2 class="font-medium">Info!</h2>
                <p>{{ content }}</p>
            </div>
        </div>

        <div
            v-else-if="type === 'success'"
            class="flex gap-4 rounded-xl bg-success/30 p-4 shadow-lg backdrop-blur md:p-8"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-12 shrink-0 stroke-success"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            <div class="text-success-content">
                <h2 class="font-medium">Success!</h2>
                <p>{{ content }}</p>
            </div>
        </div>

        <div
            v-else-if="type === 'error'"
            class="flex gap-4 rounded-xl bg-error/30 p-4 shadow-lg backdrop-blur md:p-8"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-12 shrink-0 stroke-error"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            <div class="text-error-content">
                <h2 class="font-medium">Error!</h2>
                <p>{{ content }}</p>
            </div>
        </div>

        <div
            v-else
            class="flex gap-4 rounded-xl bg-warning/30 p-4 shadow-lg backdrop-blur md:p-8"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-12 shrink-0 stroke-warning"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            <div class="text-warning-content">
                <h2 class="font-medium">Warning!</h2>
                <p>{{ content }}</p>
            </div>
        </div>
    </div>
</template>
