<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    pagination: Object,
});

const links = computed(() => {
    const { links, current_page, last_page } = props.pagination;

    return [
        ...links.slice(0, 2),
        ...(current_page - 3 > 1 ? [{ url: null, label: '...' }] : []),
        ...links
            .slice(2, -2)
            .filter((value) => Math.abs(current_page - value.label) <= 2),
        ...(current_page + 3 < last_page ? [{ url: null, label: '...' }] : []),
        ...links.slice(-2),
    ];
});
</script>
<template>
    <div class="join border border-base-content/10 bg-base-100">
        <Link
            v-for="(link, index) in links"
            :key="index"
            :href="link.url"
            :class="[
                'btn btn-ghost join-item',
                {
                    'btn-active pointer-events-none': link.active,
                    'pointer-events-none opacity-50': !link.url,
                },
            ]"
        >
            {{ link.label }}
        </Link>
    </div>
</template>
