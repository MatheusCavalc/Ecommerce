<script setup>
import CarouselHome from '@/Components/CarouselHome.vue';
import Slide from '@/Components/Slide.vue'

const carouselSlides = [
    {
        slide: 'https://assets-prd.ignimgs.com/2023/05/22/top-down-angle-1684784115328.jpg',
        description: 'GPD Win 4'
    },
    {
        slide: 'https://i.ytimg.com/vi/gtDio-nRhX8/maxresdefault.jpg',
        description: 'OneXplayer X1'
    },
    {
        slide: 'https://reviewed-com-res.cloudinary.com/image/fetch/s--xfgCLZy1--/b_white,c_fill,cs_srgb,f_auto,fl_progressive.strip_profile,g_auto,h_547,q_auto,w_972/https://reviewed-production.s3.amazonaws.com/1700614668213/playstation-portal-hero.png',
        description: 'Playstation Portal'
    }
]
</script>

<template>
    <CarouselHome class="relative h-48 lg:h-96 mx-0.5" v-slot="{ currentSlide }">
        <Slide v-for="(slide, index) in carouselSlides" :key="index">
            <div v-show="currentSlide == index + 1" class="absolute top-0 left-0 w-full max-h-full h-full">
                <img class="min-w-full h-full object-cover rounded-md" :src="slide.slide" alt="">

                <div
                    class="absolute px-2 py-2 bg-white lg:py-3 lg:px-7 bottom-36 left-2 lg:bottom-12 lg:left-16 backdrop-blur-sm bg-white/30">
                    <p class="text-base text-black font-bold md:text-4xl">{{ slide.description }}</p>
                </div>
            </div>
        </Slide>
    </CarouselHome>
</template>
