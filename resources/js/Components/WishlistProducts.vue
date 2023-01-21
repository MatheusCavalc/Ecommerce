<script setup>
import Table from '@/Components/Table.vue';
import TData from '@/Components/TData.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ref } from 'vue';

const props = defineProps(['products'])

const wishlistProducts = ref('')

wishlistProducts.value = props.products

const removeToWishList = (productId, e) => {
    e.preventDefault();
    axios.post("/wishlist/remove-to-wishlist", {
        product_id: productId,
    }).then((response) => {
        wishlistProducts.value = response.data
        console.log(response);
    });
}
</script>

<template>
    <Table>
        <template #tableRows>
            <tr v-for="wishlist in wishlistProducts" :key="wishlist.id" class="bg-white border-b hover:bg-gray-200">
                <TData type="first">
                    <img class="h-16 w-16 rounded-t-lg" :src="`/storage/${wishlist.product.image}`"
                        alt="product image" />
                </TData>
                <TData type="first">
                    {{ wishlist.product.name }}
                </TData>
                <TData type="first">
                    <p v-if="wishlist.product.on_sale == true">{{ wishlist.product.sale_price }}</p>
                    <p v-else>{{ wishlist.product.price }}</p>
                </TData>
                <TData type="normal">
                    <DangerButton class="ml-1" @click="removeToWishList(wishlist.product.id, $event)">
                        Remove
                    </DangerButton>
                </TData>
            </tr>
        </template>
    </Table>
</template>
