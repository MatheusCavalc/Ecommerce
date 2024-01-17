<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import { useToast } from "vue-toastification";
import "vue-toastification/dist/index.css";

defineProps(['products'])

const toast = useToast();

const addToWishList = (productId, e) => {
    e.preventDefault();
    axios.post("/wishlist/add-to-wishlist", {
        product_id: productId,
    }).then((response) => {
        toast(response.data['status']);
    }).catch(error => {
        if (error.response.data.message == 'Unauthenticated.') {
            window.location.href = '/login';
        }
    });
}

const addToCart = (productSlug, qty, e) => {
    e.preventDefault();
    axios.get("/cart/add/" + productSlug + "/" + qty).then((response) => {
        toast("Product add to your cart")
        //console.log(response.data['qty'])
    }).catch(error => {
        if (error.response.data.message == 'Unauthenticated.') {
            window.location.href = '/login';
        }
    });
}

</script>

<template>
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 my-4">
        <div v-for="product in products" :key="product.id">
            <div class="w-full max-w-sm bg-white rounded-lg shadow-md hover:shadow-2xl">
                <Link :href="route('product.view', product.slug)" class="h-96">
                <img class="object-contain h-52 lg:h-96 p-4 w-full rounded-t-lg" :src="`/storage/${product.image}`"
                    :alt="product.name" />
                </Link>
                <div class="px-5 pb-5">
                    <Link :href="route('product.view', product.slug)" class="">
                    <h5
                        class="text-base mb-4 lg:text-xl h-12 lg:h-14 font-semibold text-ellipsis overflow-hidden tracking-tight text-gray-900 hover:underline hover:font-bold">
                        {{ product.name }}</h5>
                    </Link>
                    <template v-if="product.on_sale">
                        <p
                            class="text-dark-grayish text-base font-bold text-gray-900 w-fit line-through decoration-dark-grayish decoration-1 my-auto">
                            ${{ product.price }}
                        </p>
                        <div class="">
                            <span class="text-2xl lg:text-3xl font-bold text-gray-900">${{ product.sale_price }}</span>
                            <div class="flex gap-2 mt-4 justify-center">
                                <Link @click="addToWishList(product.id, $event)" preserve-scroll
                                    class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm w-1/2 flex justify-center px-3 py-1 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                </Link>
                                <Link @click="addToCart(product.slug, 1, $event)" preserve-scroll
                                    class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm w-1/2 flex justify-center px-3 py-1 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                </Link>
                            </div>
                        </div>
                    </template>

                    <template v-else>
                        <div class="mt-11">
                            <span class="text-2xl lg:text-3xl font-bold text-gray-900">${{ product.price }}</span>
                            <div class="flex gap-2 mt-4 justify-center">
                                <Link @click="addToWishList(product.id, $event)" preserve-scroll
                                    class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm w-1/2 flex justify-center px-3 py-1 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                </Link>
                                <Link @click="addToCart(product.slug, 1, $event)" preserve-scroll
                                    class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm w-1/2 flex justify-center px-3 py-1 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                </Link>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
</template>
