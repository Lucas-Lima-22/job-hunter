<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
    user: Object,
})

const form = useForm({
    email: props.user.email,
    current_password: null,
    password: undefined,
})
</script>
<template>
    <Head>
        <title>Settings</title>
    </Head>
    <div class="grid min-h-inherit place-items-center sm:p-8">
        <div
            class="size-full bg-base-100 sm:h-fit sm:max-w-md sm:rounded-box sm:shadow-lg"
        >
            <div class="p-4 sm:p-8">
                <h2 class="text-2xl">Manage Your Credentials</h2>
                <h3 class="opacity-50">
                    Change your email address or update your password.
                </h3>
            </div>

            <hr class="border-base-content/10" />

            <form
                class="form-control space-y-4 p-4 sm:space-y-8 sm:p-8"
                @submit.prevent="
                    form.transform((data) => ({
                        ...data,
                        password: data.password?.length
                            ? data.password
                            : undefined,
                    })).patch(`/users/${user.id}`)
                "
            >
                <label class="form-control">
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
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium"> PASSWORD </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.current_password }}
                        </small>
                    </div>
                    <input
                        type="password"
                        placeholder="Enter your password"
                        :class="[
                            'input input-bordered',
                            { 'input-error': form.errors.current_password },
                        ]"
                        v-model="form.current_password"
                        @change="form.clearErrors('current_password')"
                        required
                    />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium">
                            NEW PASSWORD
                        </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.password }}
                        </small>
                    </div>
                    <input
                        type="password"
                        placeholder="Create a new password"
                        :class="[
                            'input input-bordered',
                            { 'input-error': form.errors.password },
                        ]"
                        v-model="form.password"
                        @change="form.clearErrors('password')"
                    />
                    <div class="label">
                        <small class="label-text-alt">
                            Leave blank if you don't want to change the
                            password.
                        </small>
                    </div>
                </label>

                <div class="form-control gap-4">
                    <button type="submit" class="btn btn-primary">
                        <span class="flex-1">UPDATE</span>
                        <i class="material-symbols-rounded"> check </i>
                    </button>
                    <Link href="/" class="btn">
                        <span class="flex-1">CANCEL</span>
                        <i class="material-symbols-rounded"> close </i>
                    </Link>
                </div>

                <div
                    class="rounded-box border border-error bg-error/20 p-4 text-error"
                >
                    <p>If you wish to permanently remove your account:</p>
                    <button
                        type="button"
                        onclick="modal.showModal()"
                        class="font-semibold"
                    >
                        Delete Account
                    </button>
                </div>
            </form>
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
                        Do you realy want to delete your account? This process
                        cannot be undone.
                    </p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row-reverse sm:gap-8">
                    <Link
                        :href="`/users/${user.id}`"
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
