<script setup>
import { computed } from 'vue'
import Company from '@/Components/Company.vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    companies: Object,
})

const pagination = computed(() => {
    return {
        links: props.companies.links,
        current_page: props.companies.current_page,
        last_page: props.companies.last_page,
    }
})
</script>
<template>
    <Head>
        <title>Companies</title>
    </Head>
    <div class="min-h-inherit p-4 sm:p-8">
        <div class="mx-auto max-w-screen-xl">
            <div
                v-if="companies.data.length"
                class="grid grid-cols-1 gap-4 sm:gap-8 md:grid-cols-2 lg:grid-cols-3"
            >
                <div
                    class="col-span-full flex items-center justify-between text-sm"
                >
                    <span>
                        {{ companies.from }} - {{ companies.to }} of
                        {{ companies.total }} companies
                    </span>
                    <div>
                        Sort by
                        <select class="bg-transparent font-medium">
                            <option selected>Name</option>
                        </select>
                    </div>
                </div>

                <Company
                    v-for="company in companies.data"
                    :key="company.id"
                    :company="company"
                />

                <div
                    v-if="companies.last_page > 1"
                    class="col-span-full text-center"
                >
                    <Pagination :pagination="pagination" />
                </div>
            </div>
        </div>
    </div>
</template>
