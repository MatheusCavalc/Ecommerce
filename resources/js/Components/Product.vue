<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
import "vue-toastification/dist/index.css";

const props = defineProps(['product'])

const toast = useToast();
let qty = ref('')

qty.value = 1

const decreaseQty = () => {
    if (qty.value == 1) {
        qty.value
    } else {
        qty.value--
    }
}

const increaseQty = () => {
    if (qty.value == 5) {
        qty.value
    } else {
        qty.value++
    }
}

const addToWishList = (productId, e) => {
    e.preventDefault();
    axios.post("/wishlist/add-to-wishlist", {
        product_id: productId,
    }).then((response) => {
        toast(response.data['status']);
    });
}

const addToCart = (productSlug, qty, e) => {
    e.preventDefault();
    axios.get("/cart/add/" + productSlug + "/" + qty).then((response) => {
        toast("Product add to your cart")
        //console.log(response.data['qty'])
    });
}

const per = Math.round(100 - (props.product.sale_price * 100 / props.product.price))

</script>

<template>
    <main class="w-full flex flex-col lg:flex-row">
        <!-- Product images -->
        <section
            class="h-fit lg:w-1/2 flex-col gap-8 my-8 sm:flex sm:flex-row sm:gap-4 sm:h-full sm:mt-24 sm:mx-2 md:gap-8 md:mx-4 lg:flex-col lg:mx-0">
            <picture class="relative flex items-center bg-orange sm:bg-transparent">
                <button
                    class="bg-white w-10 h-10 flex items-center justify-center pr-1 rounded-full absolute left-6 z-10 sm:hidden"
                    id="previous-mobile">
                    <svg width="12" height="18" xmlns="http://www.w3.org/2000/svg" id="previous-mobile">
                        <path d="M11 1 3 9l8 8" stroke="#1D2026" stroke-width="3" fill="none" fill-rule="evenodd"
                            id="previous-mobile" />
                    </svg>
                </button>
                <img :src="`../storage/${product.image}`" alt="sneaker"
                    class="block sm:rounded-xl h-96 object-contain p-4 xl:w-[70%] xl:rounded-xl m-auto pointer-events-none transition duration-300 lg:w-3/4 lg:pointer-events-auto lg:cursor-pointer lg:hover:shadow-xl"
                    id="hero" />
                <button
                    class="bg-white w-10 h-10 flex items-center justify-center pl-1 rounded-full absolute right-6 z-10 sm:hidden"
                    id="next-mobile">
                    <svg width="13" height="18" xmlns="http://www.w3.org/2000/svg" id="next-mobile">
                        <path d="m2 1 8 8-8 8" stroke="#1D2026" stroke-width="3" fill="none" fill-rule="evenodd"
                            id="next-mobile" />
                    </svg>
                </button>
            </picture>

            <div
                class="thumbnails hidden justify-between gap-4 m-auto sm:flex sm:flex-col sm:justify-start sm:items-center sm:h-fit md:gap-5 lg:flex-row">
                <div id="1" class="w-1/5 cursor-pointer rounded-xl sm:w-28 md:w-32 lg:w-[72px] xl:w-[78px] ring-active">
                    <img :src="`../storage/${product.image}`" alt="thumbnail"
                        class="rounded-xl hover:opacity-50 transition active" id="thumb-1" />
                </div>
            </div>
        </section>

        <!-- Product infos -->
        <section class="lg:w-1/2 p-6 lg:mt-20 lg:pr-20 lg:py-10 2xl:pr-40 2xl:mt-40">
            <h1 class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl">
                {{ product.name }}
            </h1>
            <p class="text-dark-grayish mb-6 text-base sm:text-lg">
                {{ product.description }}
            </p>

            <template v-if="product.on_sale">
                <div class="flex items-center justify-between mb-6 sm:flex-col sm:items-start">
                    <div class="flex items-center gap-4">
                        <h3 class="text-very-dark font-bold text-3xl inline-block">
                            <p>${{ product.sale_price }}</p>
                        </h3>
                        <span
                            class="inline-block h-fit py-0.5 px-2 font-bold bg-orange-500 text-white rounded-lg text-sm">
                            {{ per }}% OFF
                        </span>
                    </div>
                    <p class="text-dark-grayish w-fit line-through decoration-dark-grayish decoration-1 my-auto">
                        ${{ product.price }}
                    </p>
                </div>
            </template>

            <template v-else>
                <div class="flex items-center justify-between mb-6 sm:flex-col sm:items-start">
                    <div class="flex items-center gap-4">
                        <h3 class="text-very-dark font-bold text-3xl inline-block">
                            <p>${{ product.price }}</p>
                        </h3>
                    </div>
                </div>
            </template>

            <div class="mb-16 lg:mb-0">
                <div
                    class="w-full h-10 text-base bg-light py-2 flex gap-6 items-center rounded-lg font-bold">
                    <button @click="decreaseQty" id="minus" class="plus-minus">
                        <div class="w-3 h-1 bg-orange-500 absolute" id="minus"></div>
                        <svg width="12" height="4" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <path
                                    d="M11.357 3.332A.641.641 0 0 0 12 2.69V.643A.641.641 0 0 0 11.357 0H.643A.641.641 0 0 0 0 .643v2.046c0 .357.287.643.643.643h10.714Z"
                                    id="a" />
                            </defs>
                            <use fill="#FF7E1B" fill-rule="nonzero" xlink:href="#a" />
                        </svg>
                    </button>

                    <span id="amount" class="select-none">{{ qty }}</span>

                    <button @click="increaseQty" id="plus" class="plus-minus">
                        <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" id="plus">
                            <defs>
                                <path
                                    d="M12 7.023V4.977a.641.641 0 0 0-.643-.643h-3.69V.643A.641.641 0 0 0 7.022 0H4.977a.641.641 0 0 0-.643.643v3.69H.643A.641.641 0 0 0 0 4.978v2.046c0 .356.287.643.643.643h3.69v3.691c0 .356.288.643.644.643h2.046a.641.641 0 0 0 .643-.643v-3.69h3.691A.641.641 0 0 0 12 7.022Z"
                                    id="b" />
                            </defs>
                            <use fill="#FF7E1B" fill-rule="nonzero" xlink:href="#b" id="plus" />
                        </svg>
                    </button>
                </div>

                <div class="mt-7 flex gap-4 items-center justify-between w-full">
                    <Link @click="addToWishList(product.id, $event)" preserve-scroll
                        class="w-1/2 h-10 bg-orange-500 py-2 flex items-center justify-center gap-4 text-xs text-white rounded-lg font-bold text-light shadow-md shadow-orange hover:brightness-125 transition select-none"
                        id="add-cart">
                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 20"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    Add to wishlist
                    </Link>

                    <Link @click="addToCart(product.slug, qty, $event)" preserve-scroll
                        class="w-1/2 h-10 bg-orange-500 py-2 flex items-center justify-center gap-4 text-xs text-white rounded-lg font-bold text-light shadow-md shadow-orange hover:brightness-125 transition select-none"
                        id="add-cart">
                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>

                    Add to cart
                    </Link>
                </div>
            </div>
        </section>
    </main>
</template>
