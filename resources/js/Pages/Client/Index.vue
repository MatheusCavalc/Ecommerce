<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import CarouselHome from '@/Components/CarouselHome.vue';
import Slide from '@/Components/Slide.vue'
import ProductsList from '@/Components/ProductsList.vue';

const props = defineProps(['categories', 'products', 'sale_products'])

const carouselSlides = [
    "https://files.tecnoblog.net/wp-content/uploads/2020/07/samsung-galaxy-m31.jpg",
    "https://tecseniorcel.com.br/wp-content/uploads/2020/05/conserto-celular-samsung-em-piracicaba.jpg",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTq4xytif_q7XXuMkHxW_u91JYIvdoSUtYzUg&usqp=CAU"
]
</script>

<template>
    <MainLayout title="Home E-commerce" :categories="categories">
        <div class="py-12">
            <CarouselHome class="carousel"
                v-slot="{ currentSlide }">
                <Slide v-for="(slide, index) in carouselSlides" :key="index">
                    <div v-show="currentSlide == index + 1" class="slide-info">
                        <img :src="slide" alt="">
                    </div>
                </Slide>
            </CarouselHome>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <p class="text-very-dark mb-4 font-bold text-3xl text-center lg:text-4xl ml-4 mt-6">
                        Shop all latest offers
                    </p>
                    <ProductsList :products="sale_products" />
                </div>

                <div class="bg-white overflow-hidden sm:rounded-lg mt-5">
                    <p class="text-very-dark mb-4 font-bold text-3xl text-center lg:text-4xl ml-4 mt-6">
                        Products
                    </p>
                    <ProductsList :products="products" />

                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.carousel {
    position: relative;
    max-height: 100vh;
    height: 100vh;
}

.slide-info {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    max-height: 100%;
    height: 100%;
}

.slide-info img {
    min-width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
