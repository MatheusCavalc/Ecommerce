<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Table from '@/Components/Table.vue';
import TData from '@/Components/TData.vue';
import THead from '@/Components/THead.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps(['orders'])
</script>

<template>
    <MainLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                        My Orders:
                    </p>

                    <div class="overflow-hidden mt-5 shadow-sm sm:rounded-lg">
                        <Table :paginator="orders">
                            <template #headColumns>
                                <THead label="ID" />
                                <THead label="Status Payment" />
                                <THead label="Total Price" />
                                <THead label="Details" />
                            </template>
                            <template #tableRows>
                                <tr v-for="order in orders" :key="order.id" class="bg-white border-b hover:bg-gray-200">
                                    <TData type="first">
                                        {{ order.id }}
                                    </TData>

                                    <TData type="first">
                                        {{ order.status_payment }}
                                    </TData>

                                    <TData type="first">
                                        {{ order.total_price }}
                                    </TData>

                                    <TData type="normal">
                                        <Link :href="route('dashboard.orders.details', order.id)">
                                        <PrimaryButton>
                                            Details
                                        </PrimaryButton>
                                        </Link>
                                    </TData>
                                </tr>
                            </template>
                        </Table>

                    </div>
                </div>
            </div>
        </div>

    </MainLayout>
</template>
