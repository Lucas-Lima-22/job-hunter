<script setup>
import { Link } from '@inertiajs/vue3'
import IconField from '@/Components/IconField.vue'

defineProps({
    candidate: Object,
})
</script>
<template>
    <Head>
        <title>{{ candidate.name ?? 'Candidate' }}</title>
    </Head>
    <div v-if="candidate.is_active" class="min-h-inherit sm:p-8">
        <div
            class="relative mx-auto max-w-screen-lg bg-base-100 sm:rounded-xl sm:shadow-lg"
        >
            <Link
                :href="`/candidates/${candidate.id}/edit`"
                class="btn btn-square absolute right-4 top-4 z-[1] sm:right-8 sm:top-8"
            >
                <i class="material-symbols-rounded"> edit_square </i>
            </Link>

            <div class="flex flex-col gap-4 p-4 sm:gap-8 sm:p-8 lg:flex-row">
                <div class="avatar">
                    <div class="mask mask-squircle mx-auto size-52 bg-neutral">
                        <img
                            v-if="candidate.avatar"
                            :src="'/storage/' + candidate.avatar"
                        />
                        <div v-else class="grid size-full place-items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 -960 960 960"
                                class="size-32 fill-neutral-content"
                            >
                                <path
                                    d="M360-390q-21 0-35.5-14.5T310-440q0-21 14.5-35.5T360-490q21 0 35.5 14.5T410-440q0 21-14.5 35.5T360-390Zm240 0q-21 0-35.5-14.5T550-440q0-21 14.5-35.5T600-490q21 0 35.5 14.5T650-440q0 21-14.5 35.5T600-390ZM480-160q134 0 227-93t93-227q0-24-3-46.5T786-570q-21 5-42 7.5t-44 2.5q-91 0-172-39T390-708q-32 78-91.5 135.5T160-486v6q0 134 93 227t227 93Zm0 80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="flex-1 space-y-4 sm:space-y-8">
                    <ul class="text-center lg:text-start">
                        <li class="text-2xl sm:text-3xl md:text-4xl">
                            {{ candidate.name }}
                        </li>
                        <li class="text-lg opacity-50 sm:text-xl md:text-2xl">
                            {{ candidate.headline }}
                        </li>
                    </ul>
                    <div class="space-y-4">
                        <IconField icon="pin_drop">
                            {{ candidate.street }}, {{ candidate.city }} -
                            {{ candidate.state }}
                        </IconField>

                        <IconField icon="mail">
                            {{ candidate.email }}
                        </IconField>

                        <IconField icon="smartphone">
                            {{ candidate.phone }}
                        </IconField>
                    </div>
                </div>
            </div>

            <hr class="border-base-content/10" />

            <div class="space-y-4 p-4 sm:space-y-8 sm:p-8">
                <section class="space-y-4 sm:space-y-8">
                    <h2 class="font-medium">SUMMARY</h2>
                    <p class="text-justify leading-8">
                        {{ candidate.summary }}
                    </p>
                </section>

                <section class="space-y-4 sm:space-y-8">
                    <h2 class="font-medium">EXPERIENCE</h2>
                    <p class="text-justify leading-8">
                        {{ candidate.experience }}
                    </p>
                </section>

                <section class="space-y-4 sm:space-y-8">
                    <h2 class="font-medium">SKILLS</h2>
                    <p class="text-justify leading-8">
                        {{ candidate.skills }}
                    </p>
                </section>

                <section class="space-y-4 sm:space-y-8">
                    <h2 class="font-medium">EDUCATION</h2>
                    <p class="text-justify leading-8">
                        {{ candidate.education }}
                    </p>
                </section>
            </div>
        </div>
    </div>

    <div v-else class="min-h-inherit p-4 sm:grid sm:place-items-center sm:p-8">
        <div class="text-center">
            <h2 class="text-2xl">Your profile is incomplete.</h2>
            <p class="mt-2">
                Please complete all required information to unlock full access
                to the platform.
            </p>
            <Link
                :href="`/candidates/${candidate.id}/edit`"
                class="btn btn-primary btn-wide mt-4"
            >
                <span class="flex-1">COMPLETE YOUR PROFILE</span>
                <i class="material-symbols-rounded">
                    keyboard_double_arrow_right
                </i>
            </Link>
        </div>
    </div>
</template>
