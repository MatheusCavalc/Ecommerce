<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ProductsList from '@/Components/ProductsList.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps(['categories', 'search', 'products'])
</script>

<template>

    <Head :title="search" />
    <MainLayout :categories="categories">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
                    <template v-if="products != 0">
                        <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                            Products {{ search }}:
                        </p>

                        <ProductsList :products="products" />
                    </template>

                    <template v-if="products == 0">
                        <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                            Não há produtos que correspondem à sua busca.
                        </p>

                    </template>

                </div>
            </div>
        </div>


    </MainLayout>

</template>
