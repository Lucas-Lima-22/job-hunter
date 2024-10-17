<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    role_id: '',
    email: null,
    password: null,
})
</script>
<template>
    <Head>
        <title>Sign Up</title>
    </Head>
    <div class="grid min-h-inherit place-items-center sm:p-8">
        <div
            class="size-full bg-base-100 sm:h-fit sm:max-w-md sm:rounded-box sm:shadow-lg"
        >
            <div class="flex items-center p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Create Your Account</h2>
                    <h3 class="opacity-50">
                        Enter your information below to sign up.
                    </h3>
                </div>
                <Link href="/" class="hidden sm:btn sm:btn-square sm:flex-none">
                    <i class="material-symbols-rounded"> close </i>
                </Link>
            </div>

            <hr class="border-base-content/10" />

            <form
                @submit.prevent="form.post('/users')"
                class="form-control space-y-4 p-4 sm:space-y-8 sm:p-8"
            >
                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium"> PROFILE </span>
                        <small class="label-text-alt text-error">
                            {{ form.errors.role_id }}
                        </small>
                    </div>
                    <select
                        class="select select-bordered"
                        v-model="form.role_id"
                        required
                    >
                        <option value="" disabled>Select your profile</option>
                        <option :value="1">Candidate</option>
                        <option :value="2">Company</option>
                    </select>
                </label>

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
                            {{ form.errors.password }}
                        </small>
                    </div>
                    <input
                        type="password"
                        placeholder="Create a password"
                        :class="[
                            'input input-bordered',
                            { 'input-error': form.errors.password },
                        ]"
                        v-model="form.password"
                        @change="form.clearErrors('password')"
                        required
                    />
                    <div class="label">
                        <small class="label-text-alt">
                            Ensure your password is at least 6 characters.
                        </small>
                    </div>
                </label>

                <button type="submit" class="btn btn-primary">SIGN UP</button>

                <p class="text-center">
                    Already have an account?
                    <Link href="/login" class="link link-primary"> Login </Link>
                </p>
            </form>
        </div>
    </div>
</template>
