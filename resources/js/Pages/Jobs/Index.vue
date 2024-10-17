<script setup>
import { computed, ref, watch } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import Job from '@/Components/Job.vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    jobs: Object,
    filters: Object,
    selected: Object,
})

const pagination = computed(() => {
    return {
        links: props.jobs.links,
        current_page: props.jobs.current_page,
        last_page: props.jobs.last_page,
    }
})

const form = useForm({
    title: props.selected.title ?? [],
    cities: props.selected.cities ?? [],
    companies: props.selected.companies ?? [],
    salaries: props.selected.salaries ?? undefined,
    schedules: props.selected.schedules ?? [],
    models: props.selected.models ?? [],
    tags: props.selected.tags ?? [],
})

watch(form, () => form.get('/jobs'))

const titleQuery = ref(null)
const cityQuery = ref(null)
const companyQuery = ref(null)
const salaryRange = ref(props.selected.salaries ?? props.filters.salaries.min)

const filtered = computed(() => {
    return {
        titles: titleQuery.value
            ? props.filters.title.filter((title) =>
                  title.toLowerCase().includes(titleQuery.value.toLowerCase())
              )
            : props.filters.title,

        cities: cityQuery.value
            ? props.filters.cities.filter((city) =>
                  city.toLowerCase().includes(cityQuery.value.toLowerCase())
              )
            : props.filters.cities,

        companies: companyQuery.value
            ? props.filters.companies.filter((company) =>
                  company
                      .toLowerCase()
                      .includes(companyQuery.value.toLowerCase())
              )
            : props.filters.companies,
    }
})
</script>
<template>
    <Head>
        <title>Jobs</title>
    </Head>
    <div v-if="jobs.data.length" class="min-h-inherit p-4 sm:p-8">
        <div
            class="grid grid-cols-1 xl:mx-auto xl:w-fit xl:grid-cols-[auto_auto] xl:gap-8"
        >
            <!-- LARGE SCREEN FILTER -->
            <div
                class="hidden xl:block xl:h-fit xl:w-80 xl:overflow-hidden xl:rounded-box xl:border xl:border-base-content/10 xl:bg-base-100"
            >
                <!-- TITLE FILTER -->
                <div>
                    <div class="label bg-base-300 p-4">
                        <h2 class="label-text font-medium">TITLE</h2>
                    </div>
                    <div class="space-y-4 p-4">
                        <label
                            class="input input-bordered flex items-center gap-2"
                        >
                            <input
                                type="text"
                                class="grow"
                                v-model="titleQuery"
                            />
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="h-5 w-5 opacity-70"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </label>

                        <ul
                            v-if="filtered.titles.length"
                            class="max-h-80 space-y-4 overflow-y-auto"
                        >
                            <li
                                v-for="(title, index) in filtered.titles"
                                :key="index"
                                class="flex items-center gap-4"
                            >
                                <input
                                    type="checkbox"
                                    :id="'title_' + index"
                                    :value="title"
                                    v-model="form.title"
                                    class="checkbox checkbox-sm"
                                />
                                <label :for="'title_' + index" role="button">
                                    {{ title }}
                                </label>
                            </li>
                        </ul>
                        <div v-else class="truncate">
                            No results found for
                            <span class="font-medium">"{{ titleQuery }}"</span>
                        </div>
                    </div>
                </div>

                <!-- CITY FILTER -->
                <div>
                    <div class="label bg-base-300 p-4">
                        <h2 class="label-text font-medium">CITIES</h2>
                    </div>
                    <div class="space-y-4 p-4">
                        <label
                            class="input input-bordered flex items-center gap-2"
                        >
                            <input
                                type="text"
                                class="grow"
                                v-model="cityQuery"
                            />
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="h-5 w-5 opacity-70"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </label>

                        <ul
                            v-if="filtered.cities.length"
                            class="max-h-80 space-y-4 overflow-y-auto"
                        >
                            <li
                                v-for="(city, index) in filtered.cities"
                                :key="index"
                                class="flex items-center gap-4"
                            >
                                <input
                                    type="checkbox"
                                    :id="'city_' + index"
                                    :value="city"
                                    v-model="form.cities"
                                    class="checkbox checkbox-sm"
                                />
                                <label :for="'city_' + index" role="button">
                                    {{ city }}
                                </label>
                            </li>
                        </ul>
                        <div v-else class="truncate">
                            No results found for
                            <span class="font-medium">"{{ cityQuery }}"</span>
                        </div>
                    </div>
                </div>

                <!-- COMPANY FILTER -->
                <div>
                    <div class="label bg-base-300 p-4">
                        <h2 class="label-text font-medium">COMPANIES</h2>
                    </div>
                    <div class="space-y-4 p-4">
                        <label
                            class="input input-bordered flex items-center gap-2"
                        >
                            <input
                                type="text"
                                class="grow"
                                v-model="companyQuery"
                            />
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="h-5 w-5 opacity-50"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </label>
                        <ul
                            v-if="filtered.companies.length"
                            class="max-h-80 space-y-4 overflow-y-auto"
                        >
                            <li
                                v-for="(company, index) in filtered.companies"
                                :key="index"
                                class="flex items-center gap-4"
                            >
                                <input
                                    type="checkbox"
                                    :id="'company_' + index"
                                    :value="company"
                                    v-model="form.companies"
                                    class="checkbox checkbox-sm"
                                />
                                <label :for="'company_' + index" role="button">
                                    {{ company }}
                                </label>
                            </li>
                        </ul>
                        <div v-else class="truncate">
                            No results found for
                            <span class="font-medium">
                                "{{ companyQuery }}"
                            </span>
                        </div>
                    </div>
                </div>

                <!-- SALARY FILTER -->
                <div>
                    <div class="label bg-base-300 p-4">
                        <h2 class="label-text font-medium">SALARY</h2>
                    </div>
                    <div class="space-y-4 p-4">
                        <input
                            type="range"
                            :min="filters.salaries.min"
                            :max="filters.salaries.max"
                            v-model="salaryRange"
                            @mouseup="
                                form.salaries = $event.currentTarget.value
                            "
                            class="range range-sm"
                        />
                        <div class="flex justify-between">
                            <span>{{ salaryRange }}</span>
                            <span>{{ filters.salaries.max }}</span>
                        </div>
                    </div>
                </div>

                <!-- SCHEDULES FILTER -->
                <div>
                    <div class="label bg-base-300 p-4">
                        <h2 class="label-text font-medium">SCHEDULES</h2>
                    </div>

                    <ul class="max-h-80 space-y-4 overflow-y-auto p-4">
                        <li
                            v-for="(schedule, index) in filters.schedules"
                            :key="index"
                            class="flex items-center gap-4"
                        >
                            <input
                                type="checkbox"
                                :id="'schedule_' + index"
                                :value="schedule"
                                v-model="form.schedules"
                                class="checkbox checkbox-sm"
                            />
                            <label :for="'schedule_' + index" role="button">
                                {{ schedule }}
                            </label>
                        </li>
                    </ul>
                </div>

                <!-- MODELS FILTER -->
                <div>
                    <div class="label bg-base-300 p-4">
                        <h2 class="label-text font-medium">MODELS</h2>
                    </div>

                    <ul class="max-h-80 space-y-4 overflow-y-auto p-4">
                        <li
                            v-for="(model, index) in filters.models"
                            :key="index"
                            class="flex items-center gap-4"
                        >
                            <input
                                type="checkbox"
                                :id="'model_' + index"
                                :value="model"
                                v-model="form.models"
                                class="checkbox checkbox-sm"
                            />
                            <label :for="'model_' + index" role="button">
                                {{ model }}
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="max-w-screen-xl">
                <div
                    class="grid grid-cols-1 gap-4 sm:gap-8 md:grid-cols-2 2xl:grid-cols-3"
                >
                    <div
                        class="col-span-full flex items-center justify-between"
                    >
                        <!-- DRAWER TRIGGER -->
                        <label
                            for="my-drawer"
                            class="btn gap-4 bg-base-100 xl:hidden"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 -960 960 960"
                                fill="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    d="M480-120q-17 0-28.5-11.5T440-160v-160q0-17 11.5-28.5T480-360q17 0 28.5 11.5T520-320v40h280q17 0 28.5 11.5T840-240q0 17-11.5 28.5T800-200H520v40q0 17-11.5 28.5T480-120Zm-320-80q-17 0-28.5-11.5T120-240q0-17 11.5-28.5T160-280h160q17 0 28.5 11.5T360-240q0 17-11.5 28.5T320-200H160Zm160-160q-17 0-28.5-11.5T280-400v-40H160q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h120v-40q0-17 11.5-28.5T320-600q17 0 28.5 11.5T360-560v160q0 17-11.5 28.5T320-360Zm160-80q-17 0-28.5-11.5T440-480q0-17 11.5-28.5T480-520h320q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H480Zm160-160q-17 0-28.5-11.5T600-640v-160q0-17 11.5-28.5T640-840q17 0 28.5 11.5T680-800v40h120q17 0 28.5 11.5T840-720q0 17-11.5 28.5T800-680H680v40q0 17-11.5 28.5T640-600Zm-480-80q-17 0-28.5-11.5T120-720q0-17 11.5-28.5T160-760h320q17 0 28.5 11.5T520-720q0 17-11.5 28.5T480-680H160Z"
                                />
                            </svg>

                            FILTERS
                        </label>

                        <div
                            class="text-sm xl:flex xl:flex-1 xl:justify-between"
                        >
                            <span>
                                {{ jobs.from }} - {{ jobs.to }} of
                                {{ jobs.total }} jobs
                            </span>
                            <div>
                                Sort by
                                <select class="bg-transparent font-medium">
                                    <option>Date</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <Job v-for="job in jobs.data" :key="job.id" :job="job" />

                    <div
                        v-if="jobs.last_page > 1"
                        class="col-span-full text-center"
                    >
                        <Pagination :pagination="pagination" />
                    </div>
                </div>
            </div>
        </div>
        <!-- DRAWER -->
        <div class="drawer z-[2]">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-side">
                <label
                    for="my-drawer"
                    aria-label="close sidebar"
                    class="drawer-overlay"
                />
                <!-- MOBILE FILTER -->
                <div class="min-h-full w-80 bg-base-100">
                    <div class="flex items-center p-4">
                        <span class="flex-1 text-2xl">Filters</span>
                        <label for="my-drawer" class="btn btn-square flex-none">
                            <i class="material-symbols-rounded"> close </i>
                        </label>
                    </div>
                    <!-- TITLE FILTER -->
                    <div>
                        <div class="label bg-base-300 p-4">
                            <h2 class="label-text font-medium">TITLE</h2>
                        </div>
                        <div class="space-y-4 p-4">
                            <label
                                class="input input-bordered flex items-center gap-2"
                            >
                                <input
                                    type="text"
                                    class="grow"
                                    v-model="titleQuery"
                                />
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                    class="h-5 w-5 opacity-70"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </label>

                            <ul
                                v-if="filtered.titles.length"
                                class="max-h-80 space-y-4 overflow-y-auto"
                            >
                                <li
                                    v-for="(title, index) in filtered.titles"
                                    :key="index"
                                    class="flex items-center gap-4"
                                >
                                    <input
                                        type="checkbox"
                                        :id="'title_' + index"
                                        :value="title"
                                        v-model="form.title"
                                        class="checkbox checkbox-sm"
                                    />
                                    <label
                                        :for="'title_' + index"
                                        role="button"
                                    >
                                        {{ title }}
                                    </label>
                                </li>
                            </ul>
                            <div v-else class="truncate">
                                No results found for
                                <span class="font-medium">
                                    "{{ titleQuery }}"
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- CITY FILTER -->
                    <div>
                        <div class="label bg-base-300 p-4">
                            <h2 class="label-text font-medium">CITIES</h2>
                        </div>
                        <div class="space-y-4 p-4">
                            <label
                                class="input input-bordered flex items-center gap-2"
                            >
                                <input
                                    type="text"
                                    class="grow"
                                    v-model="cityQuery"
                                />
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                    class="h-5 w-5 opacity-70"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </label>

                            <ul
                                v-if="filtered.cities.length"
                                class="max-h-80 space-y-4 overflow-y-auto"
                            >
                                <li
                                    v-for="(city, index) in filtered.cities"
                                    :key="index"
                                    class="flex items-center gap-4"
                                >
                                    <input
                                        type="checkbox"
                                        :id="'city_' + index"
                                        :value="city"
                                        v-model="form.cities"
                                        class="checkbox checkbox-sm"
                                    />
                                    <label :for="'city_' + index" role="button">
                                        {{ city }}
                                    </label>
                                </li>
                            </ul>
                            <div v-else class="truncate">
                                No results found for
                                <span class="font-medium">
                                    "{{ cityQuery }}"
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- COMPANY FILTER -->
                    <div>
                        <div class="label bg-base-300 p-4">
                            <h2 class="label-text font-medium">COMPANIES</h2>
                        </div>
                        <div class="space-y-4 p-4">
                            <label
                                class="input input-bordered flex items-center gap-2"
                            >
                                <input
                                    type="text"
                                    class="grow"
                                    v-model="companyQuery"
                                />
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                    class="h-5 w-5 opacity-50"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </label>
                            <ul
                                v-if="filtered.companies.length"
                                class="max-h-80 space-y-4 overflow-y-auto"
                            >
                                <li
                                    v-for="(
                                        company, index
                                    ) in filtered.companies"
                                    :key="index"
                                    class="flex items-center gap-4"
                                >
                                    <input
                                        type="checkbox"
                                        :id="'company_' + index"
                                        :value="company"
                                        v-model="form.companies"
                                        class="checkbox checkbox-sm"
                                    />
                                    <label
                                        :for="'company_' + index"
                                        role="button"
                                    >
                                        {{ company }}
                                    </label>
                                </li>
                            </ul>
                            <div v-else class="truncate">
                                No results found for
                                <span class="font-medium">
                                    "{{ companyQuery }}"
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- SALARY FILTER -->
                    <div>
                        <div class="label bg-base-300 p-4">
                            <h2 class="label-text font-medium">SALARY</h2>
                        </div>
                        <div class="space-y-4 p-4">
                            <input
                                type="range"
                                :min="filters.salaries.min"
                                :max="filters.salaries.max"
                                v-model="salaryRange"
                                @mouseup="
                                    form.salaries = $event.currentTarget.value
                                "
                                class="range range-sm"
                            />
                            <div class="flex justify-between">
                                <span>{{ salaryRange }}</span>
                                <span>{{ filters.salaries.max }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- SCHEDULES FILTER -->
                    <div>
                        <div class="label bg-base-300 p-4">
                            <h2 class="label-text font-medium">SCHEDULES</h2>
                        </div>

                        <ul class="max-h-80 space-y-4 overflow-y-auto p-4">
                            <li
                                v-for="(schedule, index) in filters.schedules"
                                :key="index"
                                class="flex items-center gap-4"
                            >
                                <input
                                    type="checkbox"
                                    :id="'schedule_' + index"
                                    :value="schedule"
                                    v-model="form.schedules"
                                    class="checkbox checkbox-sm"
                                />
                                <label :for="'schedule_' + index" role="button">
                                    {{ schedule }}
                                </label>
                            </li>
                        </ul>
                    </div>

                    <!-- MODELS FILTER -->
                    <div>
                        <div class="label bg-base-300 p-4">
                            <h2 class="label-text font-medium">MODELS</h2>
                        </div>

                        <ul class="max-h-80 space-y-4 overflow-y-auto p-4">
                            <li
                                v-for="(model, index) in filters.models"
                                :key="index"
                                class="flex items-center gap-4"
                            >
                                <input
                                    type="checkbox"
                                    :id="'model_' + index"
                                    :value="model"
                                    v-model="form.models"
                                    class="checkbox checkbox-sm"
                                />
                                <label :for="'model_' + index" role="button">
                                    {{ model }}
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="grid min-h-inherit place-items-center">
        <div class="text-center">
            <h2 class="text-2xl">No results found</h2>
            <p>
                Unfortunately, we couldn’t find any jobs that match your
                filters.
            </p>
            <Link href="/jobs" class="link link-primary">
                Back to job listings
            </Link>
        </div>
    </div>
</template>
