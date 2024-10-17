<script setup>
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    jobs: Object,
    company: Object,
});

const pagination = computed(() => {
    return {
        links: props.jobs.links,
        current_page: props.jobs.current_page,
        last_page: props.jobs.last_page,
    };
});

const modal = ref(null);
const selected = ref(undefined);
</script>

<template>
    <Head>
        <title>{{ company.name }} - Job Listings</title>
    </Head>
    <div class="min-h-inherit sm:p-8">
        <div
            class="mx-auto min-h-inherit max-w-screen-lg bg-base-100 sm:rounded-box sm:shadow-lg"
        >
            <div class="flex items-center p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Manage and Create Job Listings</h2>
                    <h3 class="opacity-50">
                        Create new job opportunities or update existing listings
                        for your company.
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

            <div
                v-if="jobs.data.length"
                class="space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <div class="flex flex-col gap-4 sm:flex-row sm:justify-between">
                    <Link
                        href="/jobs/create"
                        class="btn btn-primary btn-block sm:btn-wide"
                    >
                        <span class="flex-1">ADD JOB</span>
                        <i class="material-symbols-rounded"> add </i>
                    </Link>
                    <div
                        class="flex justify-between text-sm sm:flex-col sm:items-end sm:justify-center"
                    >
                        <span>
                            {{ jobs.from }} - {{ jobs.to }} of
                            {{ jobs.total }} jobs
                        </span>
                        <div>
                            Sort by
                            <select class="bg-transparent font-medium">
                                <option>Created At</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table
                        class="table table-zebra border border-base-content/10"
                    >
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Salary</th>
                                <th>Schedule</th>
                                <th>Model</th>
                                <th>Created At</th>
                                <th>Applications</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="job in jobs.data" :key="job.id">
                                <td class="whitespace-nowrap">
                                    {{ job.title }}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{ job.salary }}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{ job.schedule }}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{ job.model }}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{ job.created_at }}
                                </td>
                                <td>
                                    {{ job.applications_count }}
                                </td>
                                <td class="space-x-4 whitespace-nowrap">
                                    <Link :href="`/jobs/${job.id}/edit`">
                                        <i class="material-symbols-rounded">
                                            edit
                                        </i>
                                    </Link>
                                    <button
                                        @click="
                                            (selected = job), modal.showModal()
                                        "
                                    >
                                        <i class="material-symbols-rounded">
                                            delete
                                        </i>
                                    </button>
                                    <Link :href="`/jobs/${job.id}`">
                                        <i class="material-symbols-rounded">
                                            open_in_new
                                        </i>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="jobs.last_page > 1" class="text-center">
                    <Pagination :pagination="pagination" />
                </div>
            </div>

            <div v-else class="p-4 text-center md:p-8">
                <h2 class="text-lg font-medium">No Jobs Created Yet</h2>
                <p class="mt-2">
                    It seems you haven't created any jobs yet. Start adding your
                    job listings to attract candidates and grow your business!
                </p>
                <Link href="/jobs/create" class="btn btn-primary btn-wide mt-4">
                    <span class="flex-1">CREATE YOUR FIRST JOB</span>
                    <i class="material-symbols-rounded">
                        keyboard_double_arrow_right
                    </i>
                </Link>
            </div>
        </div>
        <dialog
            ref="modal"
            class="modal modal-bottom backdrop-blur-sm sm:modal-middle"
        >
            <div
                v-if="selected"
                class="modal-box space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    stroke-width="1"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="mx-auto size-16 fill-none stroke-error"
                >
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>

                <div class="space-y-4 text-center">
                    <h2 class="text-3xl">Are you sure?</h2>
                    <p>
                        Do you realy want to delete this job? This process
                        cannot be undone.
                    </p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row-reverse sm:gap-8">
                    <button
                        @click="
                            router.delete(`/jobs/${selected.id}`), modal.close()
                        "
                        class="btn btn-error sm:flex-1"
                    >
                        <span class="flex-1">DELETE</span>
                        <i class="material-symbols-rounded"> delete </i>
                    </button>
                    <button @click="modal.close()" class="btn sm:flex-1">
                        <span class="flex-1">CANCEL</span>
                        <i class="material-symbols-rounded"> close </i>
                    </button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>
</template>
