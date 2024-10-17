<script setup>
import { computed, ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import IconField from '@/Components/IconField.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    candidate: Object,
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
const current = ref(undefined);
</script>
<template>
    <Head>
        <title>{{ candidate.name }} - Applications</title>
    </Head>
    <div class="min-h-inherit sm:p-8">
        <div
            class="mx-auto min-h-inherit max-w-screen-lg bg-base-100 md:rounded-box md:shadow-lg"
        >
            <div class="flex items-center p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Submitted Applications</h2>
                    <h3 class="opacity-50">
                        View the progress of your applications and manage your
                        actions.
                    </h3>
                </div>
                <Link
                    :href="`/candidates/${candidate.id}`"
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
                        <span class="text-sm opacity-50">DECLINED</span>
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
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Applied At</th>
                                    <th>Status</th>
                                    <th>Job</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="application in applications.data"
                                    :key="application.id"
                                >
                                    <td class="whitespace-nowrap">
                                        {{ application.work.title }}
                                    </td>
                                    <td class="whitespace-nowrap">
                                        {{ application.work.company.name }}
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
                                                current = application;
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
            <div v-else class="grid place-items-center p-4 sm:p-8">
                <h2 class="text-lg font-medium">No Applications Yet</h2>
                <p class="mt-2">
                    You haven't applied to any jobs yet. Start exploring
                    opportunities and apply to your first job now!
                </p>
                <Link href="/jobs" class="btn btn-primary btn-wide mt-4">
                    <span class="flex-1">JOB LISTINGS</span>
                    <i class="material-symbols-rounded"> add </i>
                </Link>
            </div>
        </div>
    </div>
    <dialog
        ref="modal"
        class="modal modal-bottom backdrop-blur-sm sm:modal-middle"
    >
        <div
            v-if="current"
            class="modal-box h-full max-h-full p-0 sm:h-auto sm:max-h-default"
        >
            <div class="space-y-4 p-4 sm:space-y-8 sm:p-8">
                <div class="flex items-center gap-4">
                    <h2 class="flex-1 truncate text-4xl">
                        {{ current.work.title }}
                    </h2>
                    <button @click="modal.close()" class="btn btn-square">
                        <i class="material-symbols-rounded"> close </i>
                    </button>
                </div>
                <div class="space-y-4">
                    <IconField icon="apartment">
                        <Link
                            :href="`/companies/${current.work.company.id}`"
                            class="link"
                        >
                            {{ current.work.company.name }}
                        </Link>
                    </IconField>
                    <IconField icon="pin_drop">
                        {{ current.work.company.street }},
                        {{ current.work.company.city }} -
                        {{ current.work.company.state }}
                    </IconField>
                    <IconField icon="payments">
                        {{ current.work.salary }}
                    </IconField>
                    <IconField icon="schedule">
                        {{ current.work.schedule }}
                    </IconField>
                    <IconField icon="home_work">
                        {{ current.work.model }}
                    </IconField>
                </div>
                <div class="flex flex-wrap gap-4">
                    <div
                        v-for="(tag, index) in current.work.tags"
                        :key="index"
                        class="rounded border border-base-content/50 px-4 py-1"
                    >
                        <span class="text-sm">{{ tag }}</span>
                    </div>
                </div>
            </div>

            <hr class="border-base-content/10" />

            <div class="space-y-4 p-4 sm:space-y-8 sm:p-8">
                <h2 class="font-medium">ABOUT THE ROLE</h2>
                <p class="text-justify leading-8">
                    {{ current.work.about }}
                </p>
            </div>

            <hr class="border-base-content/10" />

            <div class="p-4 sm:p-8">
                <div
                    v-if="current.status === 'pending'"
                    role="alert"
                    class="alert shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="h-12 w-12 shrink-0 stroke-info"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <div>
                        <h3 class="font-medium">Application Received!</h3>
                        <p class="text-sm">
                            We’ll notify you with any updates.
                        </p>
                    </div>
                    <button
                        @click="
                            router.delete(`/applications/${current.id}`);
                            modal.close();
                        "
                        class="btn btn-secondary btn-sm"
                    >
                        CANCEL
                    </button>
                </div>
                <div
                    v-else-if="current.status === 'approved'"
                    role="alert"
                    class="alert shadow-lg"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="h-12 w-12 shrink-0 stroke-success"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <div>
                        <h3 class="font-medium">Application Approved!</h3>
                        <p class="text-sm">
                            You’ve been approved for this job. We’ll be in touch
                            soon!
                        </p>
                    </div>
                </div>
                <div v-else role="alert" class="alert shadow-lg">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="h-12 w-12 shrink-0 stroke-error"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <div>
                        <h3 class="font-medium">Application Declined!</h3>
                        <p class="text-sm">
                            We wish you the best in your job search.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>
