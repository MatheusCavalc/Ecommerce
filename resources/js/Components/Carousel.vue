<script setup>
import CarouselHome from '@/Components/CarouselHome.vue';
import Slide from '@/Components/Slide.vue'

const carouselSlides = [
    "https://assets-prd.ignimgs.com/2023/05/22/top-down-angle-1684784115328.jpg",
    "https://i.ytimg.com/vi/gtDio-nRhX8/maxresdefault.jpg",
    "https://reviewed-com-res.cloudinary.com/image/fetch/s--xfgCLZy1--/b_white,c_fill,cs_srgb,f_auto,fl_progressive.strip_profile,g_auto,h_547,q_auto,w_972/https://reviewed-production.s3.amazonaws.com/1700614668213/playstation-portal-hero.png"
]
</script>

<template>
    <CarouselHome class="relative h-96" v-slot="{ currentSlide }">
        <Slide v-for="(slide, index) in carouselSlides" :key="index">
            <div v-show="currentSlide == index + 1" class="absolute top-0 left-0 w-full max-h-full h-full">
                <img class="min-w-full h-full object-cover" :src="slide" alt="">
            </div>
        </Slide>
    </CarouselHome>
</template>
