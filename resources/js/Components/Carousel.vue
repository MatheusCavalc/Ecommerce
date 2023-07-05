<script setup>
import CarouselHome from '@/Components/CarouselHome.vue';
import Slide from '@/Components/Slide.vue'

const carouselSlides = [
    "https://files.tecnoblog.net/wp-content/uploads/2020/07/samsung-galaxy-m31.jpg",
    "https://tecseniorcel.com.br/wp-content/uploads/2020/05/conserto-celular-samsung-em-piracicaba.jpg",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTq4xytif_q7XXuMkHxW_u91JYIvdoSUtYzUg&usqp=CAU"
]
</script>

<template>
    <CarouselHome class="relative max-h-screen h-screen" v-slot="{ currentSlide }">
        <Slide v-for="(slide, index) in carouselSlides" :key="index">
            <div v-show="currentSlide == index + 1" class="absolute top-0 left-0 w-full max-h-full h-full">
                <img class="min-w-full h-full object-cover" :src="slide" alt="">
            </div>
        </Slide>
    </CarouselHome>
</template>
