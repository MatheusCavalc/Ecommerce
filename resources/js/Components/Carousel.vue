<script setup>
import CarouselHome from '@/Components/CarouselHome.vue';
import Slide from '@/Components/Slide.vue'

const carouselSlides = [
    {
        slide: 'https://assets-prd.ignimgs.com/2023/05/22/top-down-angle-1684784115328.jpg',
        title: 'GPD Win 4',
        description: 'Com visual parecido com o PSP da Sony, GPD Win 4 é praticamente um notebook gamer super compacto com potência para rodar grandes jogos.'
    },
    {
        slide: 'https://i.ytimg.com/vi/gtDio-nRhX8/maxresdefault.jpg',
        title: 'OneXplayer X1',
        description: 'O OneXPlayer X1 é o mais novo híbrido gamer portátil, combinando funções de notebook, console portátil e tablet.'
    },
    {
        slide: 'https://reviewed-com-res.cloudinary.com/image/fetch/s--xfgCLZy1--/b_white,c_fill,cs_srgb,f_auto,fl_progressive.strip_profile,g_auto,h_547,q_auto,w_972/https://reviewed-production.s3.amazonaws.com/1700614668213/playstation-portal-hero.png',
        title: 'Playstation Portal',
        description: 'O reprodutor remoto PlayStation Portal™ dá acesso aos jogos do seu PS5 por meio da sua rede Wi-Fi de casa1.'
    }
]
</script>

<template>
    <CarouselHome class="relative h-48 lg:h-96 mx-0.5 z-10" v-slot="{ currentSlide }">
        <Slide v-for="(slide, index) in carouselSlides" :key="index">
            <div v-show="currentSlide == index + 1" class="absolute top-0 left-0 w-full max-h-full h-full">
                <img class="min-w-full h-full object-cover rounded-md" :src="slide.slide" alt="">

                <div
                    class="absolute px-2 py-2 bg-white lg:py-3 lg:px-7 left-2 top-24 lg:left-16 backdrop-blur-sm bg-white/30 lg:w-1/3">
                    <p class="text-2xl text-black font-bold md:text-4xl">{{ slide.title }}</p>

                    <p class="hidden lg:block font-sm mt-2">{{ slide.description }}</p>

                    <button class="py-2.5 px-5 me-2 mb-2 text-sm font-medium lg:font-bold text-white focus:outline-none bg-orange-500 rounded-lg border border-orange-500 hover:bg-orange-300 mt-2">View More</button>
                </div>
            </div>
        </Slide>
    </CarouselHome>
</template>
