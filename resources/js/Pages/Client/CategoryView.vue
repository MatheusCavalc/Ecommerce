<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ProductsList from '@/Components/ProductsList.vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['categories', 'products'])
</script>

<template>
    <MainLayout :categories="categories">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
                    <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                        Similar Products:
                    </p>

                    <ProductsList :products="products" />

                </div>
            </div>
        </div>
    </MainLayout>

</template>
