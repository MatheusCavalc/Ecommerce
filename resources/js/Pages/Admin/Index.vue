<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['users', 'categories', 'products', 'sales'])
</script>

<template>
    <AdminLayout>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mb-2 text-2xl flex justify-start">
                    Admin Infos
                </div>

                <div class="overflow-hidden shadow-sm sm:rounded-lg py-3 px-3">

                    <div class="grid grid-cols-4 gap-4">

                        <div>
                            <a href="#"
                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                                <h5 class="mb-2 text-2xl text-center font-bold h-16 tracking-tight">
                                    Users
                                </h5>
                                <p class="font-normal text-center text-gray-700">
                                    {{ users }}
                                </p>
                            </a>
                        </div>

                        <div>
                            <Link :href="route('admin.categories.index')"
                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                                <h5 class="mb-2 text-2xl text-center font-bold h-16 tracking-tight">
                                    Categories
                                </h5>
                                <p class="font-normal text-center text-gray-700">
                                    {{ categories }}
                                </p>
                            </Link>
                        </div>

                        <div>
                            <Link :href="route('admin.products.index')"
                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                                <h5 class="mb-2 text-2xl text-center font-bold h-16 tracking-tight">
                                    Products
                                </h5>
                                <p class="font-normal text-center text-gray-700">
                                    {{ products }}
                                </p>
                            </Link>
                        </div>

                        <div>
                            <Link :href="route('admin.orders.paid-orders')"
                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                                <h5 class="mb-2 text-2xl text-center font-bold h-16 tracking-tight">
                                    Completed Sales
                                </h5>
                                <p class="font-normal text-center text-gray-700">
                                    {{ sales }}
                                </p>
                            </Link>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </AdminLayout>
</template>
