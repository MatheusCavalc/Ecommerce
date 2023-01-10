<script setup>
const props = defineProps(['label'])
</script>

<template>
    <th scope="col" class="py-3 px-6">{{ props.label }}</th>
</template>
