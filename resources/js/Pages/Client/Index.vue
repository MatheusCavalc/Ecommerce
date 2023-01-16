<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import CarouselHome from '@/Components/CarouselHome.vue';
import ProductsList from '@/Components/ProductsList.vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['categories', 'products'])
</script>

<template>
    <MainLayout title="Home E-commerce" :categories="categories">
        <div class="py-12">
            <CarouselHome></CarouselHome>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">

                    <ProductsList :products="products" />

                </div>
            </div>
        </div>
    </MainLayout>
</template>
