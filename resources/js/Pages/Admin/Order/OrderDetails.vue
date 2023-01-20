<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Table from '@/Components/Table.vue';
import TData from '@/Components/TData.vue';
import THead from '@/Components/THead.vue';

defineProps(['order'])
</script>

<template>
    <AdminLayout>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    <div class="mb-2 text-2xl flex justify-start">
                        ORDER SUMMARY:
                    </div>
                    <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">

                    <div class="mb-3">
                        <p class="my-2">Order ID: {{ order.id }}</p>

                        <p class="my-2">Order Date: {{ order.created_at }}</p>
                        <p class="my-2">Order Total: ${{ order.total_price }}</p>
                        <p class="my-2">Order Payment: {{ order.status_payment }}</p>


                        <p class="my-2"> SHIPPING ADDRESS: {{ order.state }}, {{ order.city }}, {{ order.address1 }}</p>
                        <p class="my-2"> ZIPCODE: {{ order.zipcode }}</p>
                    </div>

                    <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="my-2 text-xl flex justify-start">
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

    </AdminLayout>
</template>
