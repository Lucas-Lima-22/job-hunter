<script setup>
import { computed, ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import IconField from '@/Components/IconField.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    company: Object,
    applications: Object,
    status: Object,
});

const pagination = computed(() => {
    return {
        links: props.applications.links,
        current_page: props.applications.current_page,
        last_page: props.applications.last_page,
    };
});

const modal = ref(null);
const selected = ref(undefined);
</script>
<template>
    <Head>
        <title>{{ company.name }} - Applications</title>
    </Head>
    <div class="min-h-inherit sm:p-8">
        <div
            class="mx-auto min-h-inherit max-w-screen-lg bg-base-100 sm:rounded-box sm:shadow-lg"
        >
            <div class="flex items-center p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Job Applications</h2>
                    <h3 class="opacity-50">
                        Review, approve, or reject candidates for your company's
                        open positions.
                    </h3>
                </div>
                <Link
                    :href="`/companies/${company.id}`"
                    class="hidden sm:btn sm:btn-square sm:flex-none"
                >
                    <i class="material-symbols-rounded"> close </i>
                </Link>
            </div>

            <hr class="border-base-content/10" />

            <div v-if="status.total">
                <div
                    class="grid grid-cols-2 gap-px bg-base-content/10 md:grid-cols-4"
                >
                    <button
                        @click="router.get('?status=pending')"
                        :class="[
                            'btn size-full flex-col rounded-none py-4',
                            { 'btn-active': status.active === 'pending' },
                        ]"
                    >
                        <span class="text-sm opacity-50">PENDING</span>
                        <span class="text-4xl">
                            {{ status.pending ?? 0 }}
                        </span>
                    </button>
                    <button
                        @click="router.get('?status=approved')"
                        :class="[
                            'btn size-full flex-col rounded-none py-4',
                            { 'btn-active': status.active === 'approved' },
                        ]"
                    >
                        <span class="text-sm opacity-50">APPROVED</span>
                        <span class="text-4xl">
                            {{ status.approved ?? 0 }}
                        </span>
                    </button>
                    <button
                        @click="router.get('?status=rejected')"
                        :class="[
                            'btn size-full flex-col rounded-none py-4',
                            { 'btn-active': status.active === 'rejected' },
                        ]"
                    >
                        <span class="text-sm opacity-50">REJECTED</span>
                        <span class="text-4xl">
                            {{ status.rejected ?? 0 }}
                        </span>
                    </button>
                    <button
                        @click="router.get('?')"
                        :class="[
                            'btn size-full flex-col rounded-none py-4',
                            { 'btn-active': status.active === null },
                        ]"
                    >
                        <span class="text-sm opacity-50">TOTAL</span>
                        <span class="text-4xl">
                            {{ status.total }}
                        </span>
                    </button>
                </div>

                <hr class="border-base-content/10" />

                <div
                    v-if="applications.data.length"
                    class="space-y-4 p-4 sm:space-y-8 sm:p-8"
                >
                    <div class="overflow-x-auto">
                        <table
                            class="table table-zebra border border-base-content/10"
                        >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Applied At</th>
                                    <th>Status</th>
                                    <th>Profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="application in applications.data"
                                    :key="application.id"
                                >
                                    <td class="whitespace-nowrap">
                                        {{ application.candidate.name }}
                                    </td>
                                    <td class="whitespace-nowrap">
                                        {{ application.work.title }}
                                    </td>
                                    <td class="whitespace-nowrap">
                                        {{ application.created_at }}
                                    </td>
                                    <td>
                                        <span
                                            :class="[
                                                'badge text-xs font-medium uppercase',
                                                {
                                                    'badge-warning':
                                                        application.status ===
                                                        'pending',
                                                    'badge-success':
                                                        application.status ===
                                                        'approved',
                                                    'badge-error':
                                                        application.status ===
                                                        'rejected',
                                                },
                                            ]"
                                        >
                                            {{ application.status }}
                                        </span>
                                    </td>
                                    <td>
                                        <button
                                            class="link"
                                            @click="
                                                selected = application;
                                                modal.showModal();
                                            "
                                        >
                                            Details
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-if="applications.last_page > 1" class="text-center">
                        <Pagination :pagination="pagination" />
                    </div>
                </div>
                <div v-else class="p-4 sm:p-8">
                    <p class="text-center opacity-50">
                        You don't have any {{ status.active }} applications at
                        the moment.
                    </p>
                </div>
            </div>
            <div v-else class="p-4 text-center sm:p-8">
                <h2 class="text-lg font-medium">No Applications Yet</h2>
                <p class="mt-2">
                    There are currently no applications for your job postings.
                    Check back later or review your listings to ensure they are
                    attracting the right candidates.
                </p>
            </div>
        </div>
    </div>
    <dialog
        ref="modal"
        class="modal modal-bottom backdrop-blur-sm sm:modal-middle"
    >
        <div
            v-if="selected"
            class="modal-box relative h-full max-h-full p-0 sm:h-auto sm:max-h-default sm:max-w-screen-lg"
        >
            <button
                @click="modal.close()"
                class="btn btn-square absolute right-4 top-4 z-[1] sm:right-8 sm:top-8"
            >
                <i class="material-symbols-rounded"> close </i>
            </button>

            <div class="flex flex-col gap-4 p-4 sm:gap-8 sm:p-8 lg:flex-row">
                <div class="avatar">
                    <div class="mask mask-squircle mx-auto size-52 bg-neutral">
                        <img
                            v-if="selected.candidate.avatar"
                            :src="'/storage/' + selected.candidate.avatar"
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
                            {{ selected.candidate.name }}
                        </li>
                        <li class="text-lg opacity-50 sm:text-xl md:text-2xl">
                            {{ selected.candidate.headline }}
                        </li>
                    </ul>
                    <div class="space-y-4">
                        <IconField icon="pin_drop" class="items-center">
                            {{ selected.candidate.street }},
                            {{ selected.candidate.city }}
                            -
                            {{ selected.candidate.state }}
                        </IconField>
                        <IconField icon="mail" class="items-center">
                            {{ selected.candidate.email }}
                        </IconField>
                        <IconField icon="smartphone" class="items-center">
                            {{ selected.candidate.phone }}
                        </IconField>
                    </div>
                </div>
            </div>

            <hr class="border-base-content/10" />

            <div class="space-y-4 p-4 sm:space-y-8 sm:p-8">
                <section class="space-y-4 sm:space-y-8">
                    <h2 class="font-medium">SUMMARY</h2>
                    <p class="text-justify leading-8">
                        {{ selected.candidate.summary }}
                    </p>
                </section>

                <section class="space-y-4 lg:space-y-8">
                    <h2 class="font-medium">EXPERIENCE</h2>

                    <p class="text-justify leading-8">
                        {{ selected.candidate.experience }}
                    </p>
                </section>

                <section class="space-y-4 lg:space-y-8">
                    <h2 class="font-medium">SKILLS</h2>

                    <p class="text-justify leading-8">
                        {{ selected.candidate.skills }}
                    </p>
                </section>

                <section class="space-y-4 lg:space-y-8">
                    <h2 class="font-medium">EDUCATION</h2>

                    <p class="text-justify leading-8">
                        {{ selected.candidate.education }}
                    </p>
                </section>
            </div>

            <hr class="border-base-content/10" />

            <div class="p-4 sm:p-8">
                <div
                    v-if="selected.status === 'pending'"
                    class="flex flex-col gap-4 sm:flex-row-reverse sm:justify-center sm:gap-8"
                >
                    <button
                        @click="
                            router.put(`/applications/${selected.id}`, {
                                status: 'approved',
                            });
                            modal.close();
                        "
                        class="btn btn-primary btn-block sm:btn-wide"
                    >
                        <span class="flex-1">APPROVE</span>
                        <span class="material-symbols-rounded"> check </span>
                    </button>
                    <button
                        @click="
                            router.put(`/applications/${selected.id}`, {
                                status: 'rejected',
                            });
                            modal.close();
                        "
                        class="btn btn-secondary btn-block sm:btn-wide"
                    >
                        <span class="flex-1">REJECT</span>
                        <span class="material-symbols-rounded"> close </span>
                    </button>
                </div>
                <p v-else class="text-center opacity-50">
                    This application has already been
                    {{ selected.status }}.
                </p>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>
