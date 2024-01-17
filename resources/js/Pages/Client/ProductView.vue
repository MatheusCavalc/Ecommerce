<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Product from '@/Components/Product.vue';
import ProductsList from '@/Components/ProductsList.vue';

const props = defineProps(['categories', 'product', 'products'])
</script>

<template>
    <MainLayout :title="product.name" :categories="categories">
        <div class="pt-4 pb-20">
            <div class="w-full mx-auto px-2 lg:px-8">
                <div class="bg-white overflow-hidden rounded-lg">
                    <Product :product="product" />
                </div>

                <div class="bg-white overflow-hidden rounded-lg mt-6 px-3">
                    <p class="text-very-dark mb-4 text-center font-bold text-2xl lg:text-4xl ml-4 mt-6">
                        Similar Products:
                    </p>

                    <ProductsList :products="products" />

                </div>
            </div>
        </div>
    </MainLayout>

</template>
