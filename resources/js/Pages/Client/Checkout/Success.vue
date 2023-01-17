<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps(['categories', 'session'])

</script>

<template>
    <Head title="Success"/>
    <MainLayout :categories="categories">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
                    <div class="bg-white flex justify-center">
                        <div class="bg-white p-6 md:mx-auto">
                            <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
                                <path fill="currentColor"
                                    d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                                </path>
                            </svg>
                            <div class="text-center">
                                <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Done!
                                </h3>
                                <p class="text-gray-600 my-2">Thank you for completing your secure online payment. Check
                                    your email for more infos about your buy</p>
                                <p> Have a great day! </p>
                                <div class="py-10 text-center">
                                    <Link :href="route('home')"
                                        class="bg-orange-500 hover:bg-orange-700 px-5 py-3 text-sm rounded-lg text-white text-lg uppercase">
                                        Home Page
                                </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
