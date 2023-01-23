<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Table from '@/Components/Table.vue';
import TData from '@/Components/TData.vue';
import THead from '@/Components/THead.vue';

defineProps(['order'])
</script>

<template>
    <MainLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                        Order Summary:
                    </p>
                    <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">

                    <div class="mb-3 mx-6">
                        <p class="my-2">Order ID: {{ order.id }}</p>

                        <p class="my-2">Order Date: {{ order.created_at }}</p>
                        <p class="my-2">Order Total: ${{ order.total_price }}</p>
                        <p class="my-2">Order Payment: {{ order.status_payment }}</p>

                        <p class="my-2"> SHIPPING ADDRESS: {{ order.state }}, {{ order.city }}, {{ order.address1 }}</p>
                        <p class="my-2"> ZIPCODE: {{ order.zipcode }}</p>
                    </div>

                    <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="my-2 mx-6 text-xl flex justify-start">
                        Products:
                    </div>
                    <Table>
                        <template #headColumns>
                            <THead label="Item" />
                            <THead label="Quantity" />
                            <THead label="Price (Total)" />
                        </template>
                        <template #tableRows>
                            <tr v-for="product in order.products" class="bg-white border-b hover:bg-gray-200">
                                <TData type="first">
                                    {{ product['name'] }}
                                </TData>
                                <TData type="first">
                                    {{ product['qty'] }}
                                </TData>
                                <TData type="first">
                                    ${{ product['total_price'] }}
                                </TData>
                            </tr>
                        </template>
                    </table>


                </div>
            </div>
        </div>

    </MainLayout>
</template>
