<script setup>
import { computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import IconField from '@/Components/IconField.vue';

const props = defineProps({
    job: Object,
    application: Object,
});

const user = computed(() => usePage().props.auth.user);
</script>
<template>
    <Head>
        <title>{{ job.title }}</title>
    </Head>
    <div class="min-h-inherit sm:p-8">
        <div
            class="mx-auto max-w-screen-md divide-y divide-base-content/10 bg-base-100 sm:rounded-box sm:shadow-lg"
        >
            <div class="space-y-4 p-4 sm:space-y-8 sm:p-8">
                <div class="flex items-start gap-4">
                    <h2 class="flex-1 text-4xl sm:text-5xl">
                        {{ job.title }}
                    </h2>

                    <div
                        v-if="job.belongs_to_user"
                        class="dropdown dropdown-end"
                    >
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
                                    :href="`/jobs/${job.id}/edit`"
                                    class="gap-4"
                                >
                                    <i class="material-symbols-rounded">
                                        edit_square
                                    </i>
                                    <span class="font-medium"> Edit </span>
                                </Link>
                            </li>
                            <li>
                                <button
                                    onclick="modal.showModal()"
                                    class="gap-4"
                                >
                                    <i class="material-symbols-rounded">
                                        delete
                                    </i>
                                    <span class="font-medium"> Delete </span>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <button v-else class="btn btn-square">
                        <i class="material-symbols-rounded"> share </i>
                    </button>
                </div>

                <div class="space-y-4">
                    <IconField icon="apartment">
                        <Link
                            :href="`/companies/${job.company.id}`"
                            class="link"
                        >
                            {{ job.company.name }}
                        </Link>
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

                <div class="flex flex-wrap gap-4">
                    <div
                        v-for="(tag, index) in job.tags"
                        :key="index"
                        class="rounded border border-base-content/50 px-4 py-1"
                    >
                        <span class="text-sm">{{ tag }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4 p-4 sm:space-y-8 sm:p-8">
                <h2 class="font-medium">ABOUT THE ROLE</h2>
                <p class="text-justify leading-8">
                    {{ job.about }}
                </p>
            </div>

            <div v-if="!user" class="p-4 sm:p-8">
                <div role="alert" class="alert">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="h-6 w-6 shrink-0 stroke-info"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <p>Would you like to apply for this job?</p>
                    <Link href="/login" class="btn btn-primary btn-sm">
                        LOGIN
                    </Link>
                </div>
            </div>

            <div v-else-if="user?.role_id === 1" class="p-4 sm:p-8">
                <Transition name="fade" mode="out-in">
                    <div v-if="application">
                        <div
                            v-if="application.status === 'pending'"
                            role="alert"
                            class="alert"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="h-6 w-6 shrink-0 stroke-info"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                            <p>
                                Your application has been received. We’ll notify
                                you with any updates.
                            </p>

                            <button
                                @click="
                                    router.delete(
                                        `/applications/${application.id}`
                                    )
                                "
                                class="btn btn-primary btn-sm"
                            >
                                CANCEL
                            </button>
                        </div>
                        <div
                            v-else-if="application.status === 'approved'"
                            role="alert"
                            class="alert"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 shrink-0 fill-none stroke-success"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            <p>
                                You’ve been approved for this job. We’ll be in
                                touch soon!
                            </p>
                        </div>

                        <div v-else role="alert" class="alert">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 shrink-0 fill-none stroke-error"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            <p>
                                Your application has been declined. We wish you
                                the best in your job search.
                            </p>
                        </div>
                    </div>
                    <div
                        v-else
                        class="flex flex-wrap justify-center gap-4 sm:items-end sm:justify-between"
                    >
                        <button
                            @click="
                                router.post('/applications', {
                                    work: job,
                                    company: job.company,
                                })
                            "
                            class="btn btn-primary btn-block sm:btn-wide"
                        >
                            <span class="flex-1">APPLY NOW</span>
                            <i class="material-symbols-rounded"> check </i>
                        </button>
                        <p class="text-xs">Published on {{ job.created_at }}</p>
                    </div>
                </Transition>
            </div>
        </div>

        <dialog
            id="modal"
            class="modal modal-bottom backdrop-blur-sm sm:modal-middle"
        >
            <div class="modal-box space-y-4 p-4 sm:space-y-8 sm:p-8">
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
                    <Link
                        :href="`/jobs/${job.id}`"
                        as="BUTTON"
                        method="DELETE"
                        class="btn btn-error sm:flex-1"
                    >
                        <span class="flex-1">DELETE</span>
                        <i class="material-symbols-rounded"> delete </i>
                    </Link>
                    <button onclick="modal.close()" class="btn sm:flex-1">
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
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition-property: opacity, scale;
    transition-duration: 150ms;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    scale: 0;
}
</style>
