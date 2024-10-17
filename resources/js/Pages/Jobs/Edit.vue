<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
    job: Object,
})

const form = useForm({
    title: props.job.title,
    salary: props.job.salary,
    schedule: props.job.schedule,
    model: props.job.model,
    about: props.job.about,
    tags: props.job.tags.toString(),
})
</script>
<template>
    <Head>
        <title>{{ job.title }} - Edit</title>
    </Head>
    <div class="min-h-inherit sm:p-8">
        <div
            class="mx-auto max-w-screen-md bg-base-100 sm:rounded-box sm:shadow-lg"
        >
            <div class="flex items-center p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Update Job Information</h2>
                    <h3 class="opacity-50">
                        Modify the job details to ensure they reflect the
                        current requirements.
                    </h3>
                </div>
                <Link
                    :href="`/jobs/${job.id}`"
                    class="hidden sm:btn sm:btn-square sm:flex-none"
                >
                    <i class="material-symbols-rounded"> close </i>
                </Link>
            </div>

            <hr class="border-base-content/10" />

            <form
                @submit.prevent="
                    form.transform((data) => ({
                        ...data,
                        tags: data.tags
                            ? data.tags
                                  .split(',')
                                  .map((tag) => tag.trim())
                                  .filter((tag) => tag)
                            : null,
                    })).patch(`/jobs/${job.id}`)
                "
                class="form-control space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <div class="form-control gap-4 sm:flex-row sm:gap-8">
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium">TITLE</span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.title }}
                            </small>
                        </div>
                        <input
                            type="text"
                            placeholder="Enter the job title"
                            :class="[
                                'input input-bordered',
                                { 'input-error': form.errors.title },
                            ]"
                            v-model="form.title"
                            @change="form.clearErrors('title')"
                            required
                        />
                    </label>
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium">SALARY</span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.salary }}
                            </small>
                        </div>
                        <input
                            type="number"
                            min="50"
                            max="1000"
                            placeholder="Enter the salary range"
                            :class="[
                                'input input-bordered',
                                { 'input-error': form.errors.salary },
                            ]"
                            v-model="form.salary"
                            @change="form.clearErrors('salary')"
                            required
                        />
                    </label>
                </div>
                <div class="form-control gap-4 sm:flex-row sm:gap-8">
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium">
                                SCHEDULE
                            </span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.schedule }}
                            </small>
                        </div>
                        <select
                            :class="[
                                'select select-bordered w-full',
                                { 'select-error': form.errors.schedule },
                            ]"
                            v-model="form.schedule"
                            @change="form.clearErrors('schedule')"
                            required
                        >
                            <option disabled selected>
                                Select work schedule
                            </option>
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Contract">Contract</option>
                            <option value="Temporary">Temporary</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </label>
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium"> MODEL </span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.model }}
                            </small>
                        </div>
                        <select
                            :class="[
                                'select select-bordered w-full',
                                { 'select-error': form.errors.model },
                            ]"
                            v-model="form.model"
                            @change="form.clearErrors('model')"
                            required
                        >
                            <option disabled selected>Select job model</option>
                            <option value="On-Site">On-Site</option>
                            <option value="Remote">Remote</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </label>
                </div>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium">
                            ABOUT THE ROLE
                        </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.about }}
                        </small>
                    </div>
                    <textarea
                        :class="[
                            'textarea textarea-bordered w-full text-base',
                            { 'textarea-error': form.errors.about },
                        ]"
                        placeholder="Enter details about the role"
                        rows="10"
                        v-model="form.about"
                        @change="form.clearErrors('about')"
                        required
                    />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium">TAGS</span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.tags }}
                        </small>
                    </div>
                    <input
                        type="text"
                        pattern="^[A-Za-z, \-.]+$"
                        title="Only letters, hyphens, and periods are allowed."
                        placeholder="Enter relevant tags"
                        :class="[
                            'input input-bordered',
                            { 'input-error': form.errors.tags },
                        ]"
                        v-model="form.tags"
                        @change="form.clearErrors('tags')"
                        required
                    />
                    <div class="label">
                        <small class="label-text-alt">
                            Use commas to separate tags.
                        </small>
                    </div>
                </label>
                <div
                    class="form-control gap-4 sm:flex-row-reverse sm:justify-center sm:gap-8"
                >
                    <button type="submit" class="btn btn-primary sm:btn-wide">
                        <span class="flex-1">UPDATE</span>
                        <i class="material-symbols-rounded"> check </i>
                    </button>
                    <Link :href="`/jobs/${job.id}`" class="btn sm:btn-wide">
                        <span class="flex-1">CANCEL</span>
                        <i class="material-symbols-rounded"> close </i>
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
