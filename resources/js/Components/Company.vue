<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    company: Object,
});
</script>

<template>
    <Link
        :href="`/companies/${company.id}`"
        class="flex flex-col gap-4 rounded-box border border-base-content/10 bg-base-100 p-4"
    >
        <div class="avatar">
            <div class="mask mask-squircle mx-auto size-48 bg-neutral">
                <img v-if="company.logo" :src="'/storage/' + company.logo" />
                <div v-else class="grid size-full place-items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 -960 960 960"
                        class="size-32 fill-neutral-content"
                    >
                        <path
                            d="M200-120q-33 0-56.5-23.5T120-200v-400q0-33 23.5-56.5T200-680h80v-80q0-33 23.5-56.5T360-840h240q33 0 56.5 23.5T680-760v240h80q33 0 56.5 23.5T840-440v240q0 33-23.5 56.5T760-120H520v-160h-80v160H200Zm0-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z"
                        />
                    </svg>
                </div>
            </div>
        </div>
        <ul class="text-center">
            <li class="truncate text-2xl">
                {{ company.name }}
            </li>
            <li class="truncate text-lg opacity-50">
                {{ company.slogan }}
            </li>
        </ul>
    </Link>
</template>
