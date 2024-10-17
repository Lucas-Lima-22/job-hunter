<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null,
})
</script>
<template>
    <Head>
        <title>Login</title>
    </Head>
    <div class="grid min-h-inherit place-items-center sm:p-8">
        <div
            class="size-full bg-base-100 sm:h-fit sm:max-w-md sm:rounded-box sm:shadow-lg"
        >
            <div class="flex items-center p-4 sm:p-8">
                <div class="flex-1">
                    <h2 class="text-2xl">Welcome Back</h2>
                    <h3 class="opacity-50">
                        Log in with your email and password.
                    </h3>
                </div>
                <Link href="/" class="hidden sm:btn sm:btn-square sm:flex-none">
                    <i class="material-symbols-rounded"> close </i>
                </Link>
            </div>

            <hr class="border-base-content/10" />

            <form
                @submit.prevent="form.post('/login')"
                class="form-control space-y-4 p-4 sm:space-y-8 sm:p-8"
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
                            {{ form.errors.password }}
                        </small>
                    </div>
                    <input
                        type="password"
                        placeholder="Enter your password"
                        :class="[
                            'input input-bordered',
                            { 'input-error': form.errors.password },
                        ]"
                        v-model="form.password"
                        @change="form.clearErrors('password')"
                        required
                    />
                    <div class="label">
                        <small class="label-text-alt" />
                        <small class="label-text-alt">
                            <Link href="#" class="link link-primary">
                                Forgot your password?
                            </Link>
                        </small>
                    </div>
                </label>

                <button type="submit" class="btn btn-primary">LOGIN</button>

                <p class="text-center">
                    Don't have an account?
                    <Link href="/sign-up" class="link link-primary">
                        Sign Up
                    </Link>
                </p>
            </form>
        </div>
    </div>
</template>
