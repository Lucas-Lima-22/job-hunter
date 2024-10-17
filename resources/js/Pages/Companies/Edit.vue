<script setup>
import { computed } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    company: Object,
});

const form = useForm({
    _method: 'PATCH',
    logo: props.company.logo,
    name: props.company.name,
    slogan: props.company.slogan,
    email: props.company.email,
    website: props.company.website,
    street: props.company.street,
    city: props.company.city,
    state: props.company.state,
    about: props.company.about,
});

const url = computed(() => {
    if (form.logo) {
        return typeof form.logo == 'object'
            ? URL.createObjectURL(form.logo)
            : '/storage/' + form.logo;
    }
});
</script>
<template>
    <Head>
        <title>{{ company.name ?? 'My Company' }} - Edit</title>
    </Head>
    <div class="min-h-inherit sm:p-8">
        <div
            class="mx-auto max-w-screen-lg bg-base-100 sm:rounded-box sm:shadow-lg"
        >
            <div class="flex items-center p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Manage Your Company Profile</h2>
                    <h3 class="opacity-50">
                        Keep your company information up-to-date.
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

            <form
                @submit.prevent="form.post(`/companies/${company.id}`)"
                class="form-control space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <div class="flex flex-col gap-4 sm:gap-8 md:flex-row">
                    <div class="flex items-start justify-center">
                        <div class="avatar">
                            <div
                                class="mask mask-squircle size-[200px] bg-neutral"
                            >
                                <img v-if="form.logo" :src="url" />
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
                                            d="M200-120q-33 0-56.5-23.5T120-200v-400q0-33 23.5-56.5T200-680h80v-80q0-33 23.5-56.5T360-840h240q33 0 56.5 23.5T680-760v240h80q33 0 56.5 23.5T840-440v240q0 33-23.5 56.5T760-120H520v-160h-80v160H200Zm0-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <input
                            type="file"
                            id="logo"
                            @input="form.logo = $event.target.files[0]"
                            hidden
                        />
                        <label v-if="!form.logo" for="logo" role="button">
                            <i class="material-symbols-rounded">
                                add_photo_alternate
                            </i>
                        </label>
                        <button v-else type="button" @click="form.logo = null">
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
                                placeholder="Enter the company name"
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
                                    SLOGAN
                                </span>
                                <small class="label-text-alt text-error">
                                    {{ form.errors.slogan }}
                                </small>
                            </div>
                            <input
                                type="text"
                                placeholder="Enter the company slogan"
                                :class="[
                                    'input input-bordered',
                                    { 'input-error': form.errors.slogan },
                                ]"
                                v-model="form.slogan"
                                @change="form.clearErrors('slogan')"
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
                            placeholder="Enter the company email address"
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
                            <span class="label-text font-medium">
                                WEBSITE
                            </span>
                            <small class="label-text-alt text-error">
                                {{ form.errors.website }}
                            </small>
                        </div>
                        <input
                            type="text"
                            placeholder="Enter the company website"
                            :class="[
                                'input input-bordered',
                                { 'input-error': form.errors.website },
                            ]"
                            v-model="form.website"
                            @change="form.clearErrors('website')"
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
                        placeholder="Enter the street address"
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
                            placeholder="Enter the city"
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
                            placeholder="Enter the state"
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
                        <span class="label-text font-medium"> ABOUT US </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.about }}
                        </small>
                    </div>
                    <textarea
                        :class="[
                            'textarea textarea-bordered w-full text-base',
                            { 'textarea-error': form.errors.about },
                        ]"
                        placeholder="Enter a brief description of the company"
                        rows="10"
                        v-model="form.about"
                        @change="form.clearErrors('about')"
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
                        :href="`/companies/${company.id}`"
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
