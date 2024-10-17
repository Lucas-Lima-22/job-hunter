<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    candidate: Object,
});

const form = useForm({
    _method: 'PUT',
    avatar: props.candidate.avatar,
    name: props.candidate.name,
    headline: props.candidate.headline,
    email: props.candidate.email,
    street: props.candidate.street,
    phone: props.candidate.phone,
    city: props.candidate.city,
    state: props.candidate.state,
    summary: props.candidate.summary,
    experience: props.candidate.experience,
    skills: props.candidate.skills,
    education: props.candidate.education,
});

const url = computed(() => {
    if (form.avatar) {
        return typeof form.avatar == 'object'
            ? URL.createObjectURL(form.avatar)
            : '/storage/' + form.avatar;
    }
});
</script>
<template>
    <Head>
        <title>{{ candidate.name ?? 'Candidate' }} - Edit</title>
    </Head>
    <div class="min-h-inherit sm:p-8">
        <div
            class="mx-auto max-w-screen-lg bg-base-100 sm:rounded-box sm:shadow-lg"
        >
            <div class="flex items-center gap-8 p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Manage Your Resume</h2>
                    <h3 class="opacity-50">
                        Update your professional information to stand out.
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

            <form
                @submit.prevent="form.post(`/candidates/${candidate.id}`)"
                class="form-control space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <div class="flex flex-col gap-4 sm:gap-8 md:flex-row">
                    <div class="flex items-start justify-center">
                        <div class="avatar">
                            <div
                                class="mask mask-squircle size-[200px] bg-neutral"
                            >
                                <img v-if="form.avatar" :src="url" />
                                <div
                                    v-else
                                    class="grid size-full place-items-center"
                                >
                                    <svg
                                        class="size-32 fill-neutral-content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 -960 960 960"
                                    >
                                        <path
                                            d="M360-390q-21 0-35.5-14.5T310-440q0-21 14.5-35.5T360-490q21 0 35.5 14.5T410-440q0 21-14.5 35.5T360-390Zm240 0q-21 0-35.5-14.5T550-440q0-21 14.5-35.5T600-490q21 0 35.5 14.5T650-440q0 21-14.5 35.5T600-390ZM480-160q134 0 227-93t93-227q0-24-3-46.5T786-570q-21 5-42 7.5t-44 2.5q-91 0-172-39T390-708q-32 78-91.5 135.5T160-486v6q0 134 93 227t227 93Zm0 80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <input
                            type="file"
                            id="logo"
                            @input="form.avatar = $event.target.files[0]"
                            hidden
                        />
                        <label v-if="!form.avatar" for="logo" role="button">
                            <i class="material-symbols-rounded">
                                add_a_photo
                            </i>
                        </label>
                        <button
                            v-else
                            type="button"
                            @click="form.avatar = null"
                        >
                            <i class="material-symbols-rounded"> close </i>
                        </button>
                    </div>
                    <div class="form-control flex-1 gap-4 sm:gap-8">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text font-medium">
                                    NAME
                                </span>
                                <small class="label-text-alt text-error">
                                    {{ form.errors.name }}
                                </small>
                            </div>
                            <input
                                type="text"
                                placeholder="Enter your full name"
                                :class="[
                                    'input input-bordered',
                                    { 'input-error': form.errors.name },
                                ]"
                                v-model="form.name"
                                @change="form.clearErrors('name')"
                                required
                            />
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text font-medium">
                                    HEADLINE
                                </span>
                                <small class="label-text-alt text-error">
                                    {{ form.errors.headline }}
                                </small>
                            </div>
                            <input
                                type="text"
                                placeholder="Enter your headline"
                                :class="[
                                    'input input-bordered',
                                    { 'input-error': form.errors.headline },
                                ]"
                                v-model="form.headline"
                                @change="form.clearErrors('headline')"
                                required
                            />
                        </label>
                    </div>
                </div>
                <div class="form-control flex-1 gap-4 sm:gap-8 md:flex-row">
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium"> EMAIL </span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.email }}
                            </small>
                        </div>
                        <input
                            type="email"
                            placeholder="Enter your email address"
                            :class="[
                                'input input-bordered',
                                { 'input-error': form.errors.email },
                            ]"
                            v-model="form.email"
                            @change="form.clearErrors('email')"
                            required
                        />
                    </label>
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium"> PHONE </span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.phone }}
                            </small>
                        </div>
                        <input
                            type="text"
                            placeholder="Enter your phone number"
                            :class="[
                                'input input-bordered',
                                { 'input-error': form.errors.phone },
                            ]"
                            v-model="form.phone"
                            @change="form.clearErrors('phone')"
                            required
                        />
                    </label>
                </div>
                <label class="form-control flex-1">
                    <div class="label">
                        <span class="label-text font-medium"> STREET </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.street }}
                        </small>
                    </div>
                    <input
                        type="text"
                        placeholder="Enter your street address"
                        :class="[
                            'input input-bordered',
                            { 'input-error': form.errors.street },
                        ]"
                        v-model="form.street"
                        @change="form.clearErrors('street')"
                        required
                    />
                </label>
                <div class="form-control flex-1 gap-4 sm:gap-8 md:flex-row">
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium"> CITY </span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.city }}
                            </small>
                        </div>
                        <input
                            type="text"
                            placeholder="Enter your city"
                            :class="[
                                'input input-bordered',
                                { 'input-error': form.errors.city },
                            ]"
                            v-model="form.city"
                            @change="form.clearErrors('city')"
                            required
                        />
                    </label>
                    <label class="form-control flex-1">
                        <div class="label">
                            <span class="label-text font-medium"> STATE </span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.state }}
                            </small>
                        </div>
                        <input
                            type="text"
                            placeholder="Enter your state"
                            :class="[
                                'input input-bordered',
                                { 'input-error': form.errors.state },
                            ]"
                            v-model="form.state"
                            @change="form.clearErrors('state')"
                            required
                        />
                    </label>
                </div>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium"> SUMMARY </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.summary }}
                        </small>
                    </div>
                    <textarea
                        :class="[
                            'textarea textarea-bordered w-full text-base',
                            {
                                'textarea-error': form.errors.summary,
                            },
                        ]"
                        placeholder="Enter a brief summary about yourself"
                        rows="10"
                        v-model="form.summary"
                        @change="form.clearErrors('summary')"
                        required
                    />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium"> EXPERIENCE </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.experience }}
                        </small>
                    </div>
                    <textarea
                        :class="[
                            'textarea textarea-bordered w-full text-base',
                            {
                                'textarea-error': form.errors.experience,
                            },
                        ]"
                        placeholder="Enter your work experience"
                        rows="10"
                        v-model="form.experience"
                        @change="form.clearErrors('experience')"
                        required
                    />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium"> SKILLS </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.skills }}
                        </small>
                    </div>
                    <textarea
                        :class="[
                            'textarea textarea-bordered w-full text-base',
                            { 'textarea-error': form.errors.skills },
                        ]"
                        placeholder="Enter your skills"
                        rows="10"
                        v-model="form.skills"
                        @change="form.clearErrors('skills')"
                        required
                    />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium"> EDUCATION </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.education }}
                        </small>
                    </div>
                    <textarea
                        :class="[
                            'textarea textarea-bordered w-full text-base',
                            { 'textarea-error': form.errors.education },
                        ]"
                        placeholder="Enter your education details"
                        rows="10"
                        v-model="form.education"
                        @change="form.clearErrors('education')"
                        required
                    />
                </label>
                <div
                    class="form-control gap-4 sm:flex-row-reverse sm:justify-center sm:gap-8"
                >
                    <button type="submit" class="btn btn-primary sm:btn-wide">
                        <span class="flex-1">UPDATE</span>
                        <i class="material-symbols-rounded"> check </i>
                    </button>
                    <Link
                        :href="`/candidates/${candidate.id}`"
                        class="btn sm:btn-wide"
                    >
                        <span class="flex-1">CANCEL</span>
                        <i class="material-symbols-rounded"> close </i>
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
