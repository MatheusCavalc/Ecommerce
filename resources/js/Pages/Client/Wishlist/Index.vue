<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Table from '@/Components/Table.vue';
import TData from '@/Components/TData.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps(['categories', 'wishlist'])

const wishlistProducts = ref('')

wishlistProducts.value = props.wishlist

const removeToWishList = (productId, e) => {
    e.preventDefault();
    axios.post("/wishlist/remove-to-wishlist", {
        product_id: productId,
    }).then((response) => {
        wishlistProducts.value = response.data
    });
}
</script>

<template>
    <Head title="My Wishlist" />
    <MainLayout :categories="categories">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
                    <template v-if="wishlistProducts != 0">
                        <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                            My Wishlist:
                        </p>

                        <div class="mt-8">
                            <Table>
                                <template #tableRows>
                                    <tr v-for="wishlist in wishlistProducts" :key="wishlist.id"
                                        class="bg-white border-b hover:bg-gray-200">
                                        <TData type="first">
                                            <img class="h-16 w-16 rounded-t-lg"
                                                :src="`/storage/${wishlist.product.image}`" alt="product image" />
                                        </TData>
                                        <TData type="first">
                                            {{ wishlist.product.name }}
                                        </TData>
                                        <TData type="first">
                                            <p v-if="wishlist.product.on_sale == true">{{ wishlist.product.sale_price }}
                                            </p>
                                            <p v-else>{{ wishlist.product.price }}</p>
                                        </TData>
                                        <TData type="normal">
                                            <DangerButton class="ml-1"
                                                @click="removeToWishList(wishlist.product.id, $event)">
                                                Remove
                                            </DangerButton>
                                        </TData>
                                    </tr>
                                </template>
                            </Table>
                        </div>
                    </template>

                    <template v-if="wishlistProducts == 0">
                        <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                            Não há produtos na sua wishlist.
                        </p>

                    </template>

                </div>
            </div>
        </div>
    </MainLayout>
</template>
