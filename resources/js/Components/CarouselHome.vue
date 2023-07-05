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
        <div class="pt-0 pr-4 h-full w-full absolute flex justify-center items-center">
            <div class="flex flex-auto ml-3">
                <p @click="prevSlide" class="cursor-pointer flex items-center justify-center rounded-full w-10 h-10 bg-violet-600 text-white">-</p>
            </div>

            <div class="flex flex-1 justify-end">
                <p @click="nextSlide" class="cursor-pointer flex items-center justify-center rounded-full w-10 h-10 bg-violet-600 text-white">+</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="absolute bottom-6 w-full flex gap-4 justify-center items-center">
            <span @click="goToSlide(index)" v-for="(slide, index) in getSlideCount" :key="index"
                class="cursor-pointer w-5 h-5 rounded-2xl bg-white shadow" :class="{ 'bg-violet-600': index + 1 === currentSlide }">
            </span>
        </div>
    </div>
</template>
