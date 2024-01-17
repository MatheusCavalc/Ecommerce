<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Carousel from '../../Components/Carousel.vue';
import ProductsList from '@/Components/ProductsList.vue';

const props = defineProps(['categories', 'products', 'sale_products'])
</script>

<template>
    <MainLayout title="Home E-commerce" :categories="categories">
        <div class="pt-2 pb-36">

            <Carousel />

            <div class="max-w-7xl mx-auto mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg px-3">
                    <p class="text-very-dark mb-4 font-bold text-2xl text-center lg:text-4xl mt-6">
                        Shop all latest offers
                    </p>
                    <ProductsList :products="sale_products" />
                </div>

                <div class="bg-white overflow-hidden sm:rounded-lg mt-5 px-3">
                    <p class="text-very-dark mb-4 font-bold text-2xl text-center lg:text-4xl mt-6">
                        Products
                    </p>
                    <ProductsList :products="products" />

                </div>
            </div>
        </div>
    </MainLayout>
</template>

