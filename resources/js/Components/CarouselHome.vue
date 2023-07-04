<script setup>
import { ref, onMounted, defineProps } from 'vue';

const currentSlide = ref(1)
const getSlideCount = ref(null)
const autoPlayEnabled = ref(true);
const timeoutDuration = ref(5000);


const nextSlide = () => {
    if (currentSlide.value === getSlideCount.value) {
        currentSlide.value = 1;
        return;
    }
    currentSlide.value += 1;
};

const prevSlide = () => {
    if (currentSlide.value === 1) {
        currentSlide.value = 1;
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
        <div class="navigate">
            <div class="toggle-page left">
                <p @click="prevSlide" class="i">-</p>
            </div>

            <div class="toggle-page right">
                <p @click="nextSlide" class="i">+</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <span @click="goToSlide(index)" v-for="(slide, index) in getSlideCount" :key="index"
                :class="{ active: index + 1 === currentSlide }">
            </span>
        </div>
    </div>
</template>

<style scoped>
.navigate {
    padding: 0 16px;
    height: 100%;
    width: 100%;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
}

.navigate .toggle-page {
    display: flex;
    flex: 1;

}

.navigate .right {
    justify-content: flex-end;
}

.navigate .toggle-page .i {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    background-color: #6347c7;
    color: #fff;
}

.pagination {
    position: absolute;
    bottom: 24px;
    width: 100%;
    display: flex;
    gap: 16px;
    justify-content: center;
    align-items: center;
}

.pagination span {
    cursor: pointer;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #fff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.pagination .active {
    background-color: #6347c7;
}
</style>
