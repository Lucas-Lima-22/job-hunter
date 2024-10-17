<script setup>
import { Link } from '@inertiajs/vue3'
import Job from '@/Components/Job.vue'
import Company from '@/Components/Company.vue'

defineProps({
    jobs: Object,
    companies: Object,
})
</script>
<template>
    <Head>
        <title>Home</title>
    </Head>
    <div class="min-h-inherit p-4 sm:p-8">
        <div class="mx-auto max-w-screen-xl space-y-4 sm:space-y-8">
            <!-- FEATURED JOBS -->
            <div class="space-y-4 sm:space-y-8">
                <div class="flex items-center gap-4">
                    <span class="font-medium">FEATURED JOBS</span>
                    <hr class="border-base-content/10" />
                    <Link href="/jobs" class="link"> See All </Link>
                </div>
                <div
                    class="grid grid-cols-1 gap-4 sm:gap-8 md:grid-cols-2 xl:grid-cols-3"
                >
                    <Job v-for="job in jobs" :key="job.id" :job="job" />
                </div>
            </div>
            <!-- COMPANIES -->
            <div class="space-y-4 sm:space-y-8">
                <div class="flex items-center gap-4">
                    <span class="font-medium">FEATURED COMPANIES</span>
                    <hr class="border-base-content/10" />
                    <Link href="/companies" class="link"> See All </Link>
                </div>
                <div
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-8 lg:grid-cols-3"
                >
                    <Company
                        v-for="company in companies"
                        :key="company.id"
                        :company="company"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
