<script setup>
import { ref, computed, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useTheme } from '@/Composables/useTheme';
import Notification from '@/Components/Notification.vue';

const { theme, url } = useTheme();
const user = computed(() => usePage().props.auth.user);
const component = computed(() => usePage().component);
const message = computed(() => usePage().props.message);

onMounted(() => {
    document.querySelectorAll('.dropdown-option').forEach((item) => {
        item.addEventListener('click', () => {
            const dropdown = item.closest('.dropdown');
            const focusedElement = dropdown.querySelector(':focus');
            if (focusedElement) {
                focusedElement.blur();
            }
        });
    });
});
</script>

<template>
    <div
        class="navbar sticky top-0 z-[2] justify-between bg-base-100/80 shadow backdrop-blur"
    >
        <div class="dropdown md:hidden">
            <div tabindex="0" role="button" class="btn btn-square">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h7"
                    />
                </svg>
            </div>
            <ul
                tabindex="0"
                class="menu dropdown-content mt-4 w-48 rounded-box border border-base-content/10 bg-base-100 shadow-lg"
            >
                <button class="btn mb-2">
                    <label class="swap swap-flip">
                        <input
                            type="checkbox"
                            data-toggle-theme="light,dark"
                            :checked="theme === 'dark'"
                        />
                        <svg
                            class="swap-on size-5 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"
                            />
                        </svg>
                        <svg
                            class="swap-off size-5 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 -960 960 960"
                        >
                            <path
                                d="M480-120q-151 0-255.5-104.5T120-480q0-138 90-239.5T440-838q13-2 23 3.5t16 14.5q6 9 6.5 21t-7.5 23q-17 26-25.5 55t-8.5 61q0 90 63 153t153 63q31 0 61.5-9t54.5-25q11-7 22.5-6.5T819-479q10 5 15.5 15t3.5 24q-14 138-117.5 229T480-120Zm0-80q88 0 158-48.5T740-375q-20 5-40 8t-40 3q-123 0-209.5-86.5T364-660q0-20 3-40t8-40q-78 32-126.5 102T200-480q0 116 82 198t198 82Zm-10-270Z"
                            />
                        </svg>
                    </label>
                </button>
                <li class="dropdown-option">
                    <Link href="/" class="btn btn-ghost">
                        <span class="flex-1 text-start">Home</span>
                    </Link>
                </li>
                <li class="dropdown-option">
                    <Link href="/jobs" class="btn btn-ghost">
                        <span class="flex-1 text-start">Jobs</span>
                    </Link>
                </li>
                <li class="dropdown-option">
                    <Link href="/companies" class="btn btn-ghost">
                        <span class="flex-1 text-start">Companies</span>
                    </Link>
                </li>
            </ul>
        </div>

        <Link href="/">
            <img :src="url" alt="logo" class="h-10 sm:h-12" />
        </Link>

        <nav>
            <div class="hidden md:flex">
                <Link href="/" class="btn btn-ghost"> Home </Link>
                <Link href="/jobs" class="btn btn-ghost"> Jobs </Link>
                <Link href="/companies" class="btn btn-ghost"> Companies </Link>
                <div class="divider divider-horizontal mx-0 py-4" />
                <button class="btn btn-square btn-ghost">
                    <label class="swap swap-flip">
                        <input
                            type="checkbox"
                            data-toggle-theme="light,dark"
                            :checked="theme === 'dark'"
                        />
                        <svg
                            class="swap-on size-5 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"
                            />
                        </svg>
                        <svg
                            class="swap-off size-5 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"
                            />
                        </svg>
                    </label>
                </button>

                <div class="divider divider-horizontal mx-0 py-4" />
            </div>
            <div class="dropdown dropdown-end dropdown-hover sm:px-4">
                <div tabindex="0" class="mask mask-squircle size-12 bg-neutral">
                    <div v-if="user?.role_id === 1" class="size-full">
                        <img
                            v-if="user.candidate.avatar"
                            class="size-full object-cover"
                            :src="'/storage/' + user.candidate.avatar"
                        />
                        <div v-else class="grid size-full place-items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 -960 960 960"
                                class="size-8 fill-neutral-content"
                            >
                                <path
                                    d="M360-390q-21 0-35.5-14.5T310-440q0-21 14.5-35.5T360-490q21 0 35.5 14.5T410-440q0 21-14.5 35.5T360-390Zm240 0q-21 0-35.5-14.5T550-440q0-21 14.5-35.5T600-490q21 0 35.5 14.5T650-440q0 21-14.5 35.5T600-390ZM480-160q134 0 227-93t93-227q0-24-3-46.5T786-570q-21 5-42 7.5t-44 2.5q-91 0-172-39T390-708q-32 78-91.5 135.5T160-486v6q0 134 93 227t227 93Zm0 80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                />
                            </svg>
                        </div>
                    </div>

                    <div v-else-if="user?.role_id === 2" class="size-full">
                        <img
                            v-if="user.company.logo"
                            class="size-full object-cover"
                            :src="'/storage/' + user.company.logo"
                        />
                        <div v-else class="grid size-full place-items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 -960 960 960"
                                class="size-8 fill-neutral-content"
                            >
                                <path
                                    d="M200-120q-33 0-56.5-23.5T120-200v-400q0-33 23.5-56.5T200-680h80v-80q0-33 23.5-56.5T360-840h240q33 0 56.5 23.5T680-760v240h80q33 0 56.5 23.5T840-440v240q0 33-23.5 56.5T760-120H520v-160h-80v160H200Zm0-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z"
                                />
                            </svg>
                        </div>
                    </div>

                    <div v-else class="grid size-full place-items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 -960 960 960"
                            class="size-8 fill-neutral-content"
                        >
                            <path
                                d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Z"
                            />
                        </svg>
                    </div>
                </div>

                <div tabindex="0" class="dropdown-content pt-4">
                    <ul
                        v-if="user?.role_id === 1"
                        class="menu w-48 rounded-box border border-base-content/10 bg-base-100 shadow-lg"
                    >
                        <li class="dropdown-option">
                            <Link
                                :href="`/candidates/${user.candidate.id}`"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded">
                                    description
                                </i>
                                <span class="flex-1 text-start">
                                    My Resume
                                </span>
                            </Link>
                        </li>
                        <li
                            class="dropdown-option"
                            v-if="user.candidate.is_active"
                        >
                            <Link
                                :href="`/candidates/${user.candidate.id}/applications`"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded"> work </i>
                                <span class="flex-1 text-start">
                                    Applications
                                </span>
                            </Link>
                        </li>
                        <li class="dropdown-option">
                            <Link
                                :href="`/users/${user.id}/edit`"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded">
                                    settings
                                </i>
                                <span class="flex-1 text-start">
                                    Settings
                                </span>
                            </Link>
                        </li>
                        <li class="dropdown-option">
                            <Link
                                href="/logout"
                                as="button"
                                method="DELETE"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded"> logout </i>
                                <span class="flex-1 text-start"> Logout </span>
                            </Link>
                        </li>
                    </ul>
                    <ul
                        v-else-if="user?.role_id === 2"
                        class="menu w-48 rounded-box border border-base-content/10 bg-base-100 shadow-lg"
                    >
                        <li class="dropdown-option">
                            <Link
                                :href="`/companies/${user.company.id}`"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded">
                                    apartment
                                </i>
                                <span class="flex-1 text-start">
                                    My Company
                                </span>
                            </Link>
                        </li>

                        <li
                            class="dropdown-option"
                            v-if="user.company.is_active"
                        >
                            <Link
                                :href="`/companies/${user.company.id}/jobs`"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded"> work </i>
                                <span class="flex-1 text-start">
                                    Job Listings
                                </span>
                            </Link>
                        </li>
                        <li
                            class="dropdown-option"
                            v-if="user.company.is_active"
                        >
                            <Link
                                :href="`/companies/${user.company.id}/applications`"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded"> group </i>
                                <span class="flex-1 text-start">
                                    Applications
                                </span>
                            </Link>
                        </li>
                        <li class="dropdown-option">
                            <Link
                                :href="`/users/${user.id}/edit`"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded">
                                    settings
                                </i>
                                <span class="flex-1 text-start">
                                    Settings
                                </span>
                            </Link>
                        </li>
                        <li class="dropdown-option">
                            <Link
                                href="/logout"
                                as="button"
                                method="DELETE"
                                class="btn btn-ghost gap-4"
                            >
                                <i class="material-symbols-rounded"> logout </i>
                                <span class="flex-1 text-start"> Logout </span>
                            </Link>
                        </li>
                    </ul>
                    <ul
                        v-else
                        class="menu w-48 rounded-box border border-base-content/10 bg-base-100 shadow-lg"
                    >
                        <li class="dropdown-option">
                            <Link href="/login" class="btn btn-ghost gap-4">
                                <i class="material-symbols-rounded"> login </i>
                                <span class="flex-1 text-start"> Login </span>
                            </Link>
                        </li>
                        <li class="dropdown-option">
                            <Link href="/sign-up" class="btn btn-ghost gap-4">
                                <i class="material-symbols-rounded">
                                    person_add
                                </i>
                                <span class="flex-1 text-start"> Sign Up </span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div
        v-if="component === 'Index'"
        class="space-y-4 bg-neutral p-4 text-center text-neutral-content sm:p-8"
    >
        <p class="text-6xl sm:text-8xl" style="font-family: Anton">
            YOUR CAREER STARTS HERE
        </p>

        <p class="text-2xl sm:text-4xl" style="font-family: Anton">
            THE PERFECT JOB IS JUST A CLICK AWAY
        </p>

        <Link href="/jobs" class="btn btn-primary btn-wide">
            <span class="flex-1">EXPLORE</span>
            <i class="material-symbols-rounded">
                keyboard_double_arrow_right
            </i>
        </Link>
    </div>
    <main class="bg-base-200">
        <slot />
    </main>
    <footer
        class="grid h-40 place-items-center bg-neutral text-neutral-content"
    >
        <span> © 2024 Jobhunter. All rights reserved. </span>
    </footer>
    <Notification
        v-if="message"
        :type="message.type"
        :content="message.content"
    />
</template>
<style scoped>
main {
    min-height: calc(100vh - 216px);
}
</style>
