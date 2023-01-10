<script setup>
import { computed } from "vue";
const props = defineProps(['type']);
const classes = computed(() => {
    if (props.type === "first") {
        return "py-4 px-6 font-medium text-gray-900 whitespace-nowrap"
    }
    if (props.type === "normal") {
        return "py-4 px-6 font-medium text-gray-900 whitespace-nowrap"
    }
    if (props.type === "action") {
        return "py-4 px-6 text-right"
    }
})
</script>

<template>

    <td :class="classes">
        <slot />
    </td>
</template>
