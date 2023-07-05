<script setup>
import { ref, onMounted } from 'vue';

const currentSlide = ref(1)
const getSlideCount = ref(null)
const autoPlayEnabled = ref(true);
const timeoutDuration = ref(10000);

const nextSlide = () => {
    if (currentSlide.value === getSlideCount.value) {
        currentSlide.value = 1;
        return;
    }
    currentSlide.value += 1;
};

const prevSlide = () => {
    if (currentSlide.value === 1) {
        currentSlide.value = getSlideCount.value;
        return;
    }
    currentSlide.value -= 1;
};

const goToSlide = (index) => {
    currentSlide.value = index + 1;
};

const autoPlay = () => {
    setInterval(() => {
        nextSlide();
    }, timeoutDuration.value);
};

if (autoPlayEnabled.value) {
    autoPlay();
}

onMounted(() => {
    getSlideCount.value = document.querySelectorAll('.slide').length;
})
</script>

<template>
    <div class="carousel">
        <slot :currentSlide="currentSlide" />

        <!-- Navigation -->
        <div class="absolute flex items-center justify-center w-full h-full pt-0 pr-4">
            <div class="flex flex-auto ml-3">
                <p @click="prevSlide"
                    class="flex items-center justify-center w-10 h-10 text-white bg-orange-500 rounded-full cursor-pointer">
                    -</p>
            </div>

            <div class="flex justify-end flex-1">
                <p @click="nextSlide"
                    class="flex items-center justify-center w-10 h-10 text-white bg-orange-500 rounded-full cursor-pointer">
                    +</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="absolute flex items-center justify-center w-full gap-4 bottom-6">
            <span @click="goToSlide(index)" v-for="(slide, index) in getSlideCount" :key="index"
                class="w-5 h-5 bg-white shadow cursor-pointer rounded-2xl"
                :class="{ 'bg-orange-500': index + 1 === currentSlide }">
            </span>
        </div>
    </div>
</template>
