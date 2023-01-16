<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

defineProps(['categories'])

</script>

<template>
    <MainLayout :categories="categories">
        <div class="container mx-auto mt-10">
            <div class="flex shadow-md my-10">
                <p class="bg-red-500 text-lg">BUY FAILED! CHECK YOUR EMAIL</p>
            </div>
        </div>
    </MainLayout>
</template>
