<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Table from '@/Components/Table.vue';
import TData from '@/Components/TData.vue';
import THead from '@/Components/THead.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps(['orders'])
</script>

<template>
    <AdminLayout>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mb-2 text-2xl flex justify-start">
                    Orders
                </div>
                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    <Table :paginator="orders">
                        <template #headColumns>
                            <THead label="ID" />
                            <THead label="Status Payment" />
                            <THead label="Total Price" />
                            <THead label="Details" />
                            <THead label="Edit" />
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
                                    <Link :href="route('admin.orders.details', order.id)">
                                    <PrimaryButton>
                                        Details
                                    </PrimaryButton>
                                    </Link>
                                </TData>

                                <TData type="normal">
                                    <Link :href="route('admin.orders.edit', order.id)">
                                    <PrimaryButton>
                                        Edit
                                    </PrimaryButton>
                                    </Link>
                                </TData>
                            </tr>
                        </template>
                    </Table>

                </div>
            </div>
        </div>

    </AdminLayout>
</template>
