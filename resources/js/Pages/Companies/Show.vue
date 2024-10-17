<script setup>
import { Link } from '@inertiajs/vue3'
import IconField from '@/Components/IconField.vue'

defineProps({
    company: Object,
    hasJobs: Boolean,
})
</script>

<template>
    <Head>
        <title>{{ company.name ?? 'My Company' }}</title>
    </Head>
    <div v-if="company.is_active" class="min-h-inherit sm:p-8">
        <div
            class="relative mx-auto max-w-screen-lg bg-base-100 sm:rounded-box sm:shadow-lg"
        >
            <div class="absolute right-4 top-4 z-[1] sm:right-8 sm:top-8">
                <Link
                    v-if="company.belongs_to_user"
                    :href="`/companies/${company.id}/edit`"
                    class="btn btn-square"
                >
                    <i class="material-symbols-rounded"> edit_square </i>
                </Link>
                <div v-else class="dropdown dropdown-end">
                    <div
                        tabindex="0"
                        role="button"
                        class="btn btn-square btn-ghost"
                    >
                        <i class="material-symbols-rounded"> more_vert </i>
                    </div>
                    <ul
                        tabindex="0"
                        class="menu dropdown-content rounded-box bg-base-200 shadow-lg"
                    >
                        <li>
                            <Link
                                href="/jobs"
                                :data="{ companies: [company.name] }"
                                :class="[
                                    'gap-4',
                                    {
                                        'pointer-events-none opacity-50':
                                            !hasJobs,
                                    },
                                ]"
                            >
                                <i class="material-symbols-rounded"> work </i>
                                <span class="whitespace-nowrap font-medium">
                                    Job Listings
                                </span>
                            </Link>
                            <Link href="#" class="gap-4">
                                <i class="material-symbols-rounded"> share </i>
                                <span class="whitespace-nowrap font-medium">
                                    Share
                                </span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col gap-4 p-4 sm:gap-8 sm:p-8">
                <div class="avatar">
                    <div class="mask mask-squircle mx-auto size-48 bg-neutral">
                        <img
                            v-if="company.logo"
                            :src="'/storage/' + company.logo"
                        />
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
                    <li class="text-2xl sm:text-3xl md:text-4xl">
                        {{ company.name }}
                    </li>
                    <li class="text-lg opacity-50 sm:text-xl md:text-2xl">
                        {{ company.slogan }}
                    </li>
                </ul>
            </div>

            <hr class="border-base-content/10" />

            <div
                class="grid grid-cols-1 divide-y divide-base-content/10 md:grid-cols-2 md:divide-x md:divide-y-0"
            >
                <div class="grid place-content-center p-4 sm:p-8">
                    <div class="space-y-2 text-center">
                        <span class="text-4xl">{{ company.rating }}</span>
                        <span class="opacity-50"> / 5</span>
                        <div>
                            <div class="rating">
                                <input
                                    v-for="(value, index) in 5"
                                    :key="index"
                                    type="radio"
                                    name="rating-2"
                                    class="mask mask-star-2"
                                    :checked="value === company.rating"
                                    disabled
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-4 p-4 sm:p-8">
                    <IconField icon="pin_drop">
                        {{ company.street }}, {{ company.city }} -
                        {{ company.state }}
                    </IconField>

                    <IconField icon="mail">
                        {{ company.email }}
                    </IconField>

                    <IconField icon="language">
                        {{ company.website }}
                    </IconField>
                </div>
            </div>

            <hr class="border-base-content/10" />

            <section class="space-y-4 p-4 md:space-y-8 md:p-8">
                <h2 class="font-medium">ABOUT US</h2>
                <p class="text-justify leading-8">
                    {{ company.about }}
                </p>
            </section>
        </div>
    </div>
    <div v-else class="min-h-inherit p-4 sm:grid sm:place-items-center">
        <div class="text-center">
            <h2 class="text-2xl">Your profile is incomplete.</h2>
            <p class="mt-2">
                Please complete all required information to unlock full access
                to the platform.
            </p>
            <Link
                :href="`/companies/${company.id}/edit`"
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
