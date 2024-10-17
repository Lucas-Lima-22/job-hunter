<script setup>
defineProps({
    icon: String,
});
</script>
<template>
    <div class="flex gap-2">
        <i class="material-symbols-rounded"> {{ icon }} </i>
        <span class="truncate">
            <slot />
        </span>
    </div>
</template>
