<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps(['cartBox', 'categories', 'total_value', 'user_id'])

const form = useForm({
    total_price: props.total_value,
    products: props.cartBox,
    first_name: '',
    last_name: '',
    phone: '',
    address1: '',
    address2: '',
    city: '',
    state: '',
    zipcode: '',
    created_by: props.user_id,
})

const submit = () => {
    form.post(route('checkout.place.order'));
}
</script>

<template>
    <MainLayout :categories="categories">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden sm:rounded-lg mt-6">
                    <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-10 mt-10">
                        Checkout
                    </p>

                    <div class="grid sm:px-10 lg:grid-cols-2">
                        <div class="px-4 pt-8">
                            <p class="text-xl font-medium">Order Summary</p>
                            <p class="text-gray-400">Check your items. And select a suitable shipping method.</p>
                            <div v-for="product in cartBox" :key="product.id"
                                class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
                                <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                                    <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                                        :src="`/storage/${product.image}`" :alt="product.name" />
                                    <div class="flex w-full flex-col px-4 py-4">
                                        <span class="font-semibold">{{ product.name }}</span>
                                        <span class="float-right text-gray-400">Quantity: {{ product.qty }}</span>
                                        <p class="text-lg font-bold">${{ product.total_price }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 px-4 pt-8 lg:mt-0">
                            <p class="text-xl font-medium">Payment Details</p>
                            <p class="text-gray-400">Complete your order by providing your payment details.</p>

                            <form @submit.prevent="submit">
                                <div class="">
                                    <!--
                             <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                            <div class="relative">
                                <input type="text" id="email" name="email"
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="your.email@gmail.com" />
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                            </div>
                            <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Card Holder</label>
                            <div class="relative">
                                <input type="text" id="card-holder" name="card-holder"
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Your full name here" />
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                    </svg>
                                </div>
                            </div>
                            <label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Card Details</label>
                            <div class="flex">
                                <div class="relative w-7/12 flex-shrink-0">
                                    <input type="text" id="card-no" name="card-no"
                                        class="w-full rounded-md border border-gray-200 px-2 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="xxxx-xxxx-xxxx-xxxx" />
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z" />
                                            <path
                                                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z" />
                                        </svg>
                                    </div>
                                </div>
                                <input type="text" name="credit-expiry"
                                    class="w-full rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="MM/YY" />
                                <input type="text" name="credit-cvc"
                                    class="w-1/6 flex-shrink-0 rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="CVC" />
                            </div> ANTIGAS INFORMACOES DE CARTAO PARA PAYMENT
                        -->

                                    <div class="mt-1">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="flex-auto">
                                                <label for="first_name" class="mt-4 mb-2 block text-sm font-medium">
                                                    First Name
                                                </label>
                                                <input type="text" id="first_name" v-model="form.first_name"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="First Name" />
                                                <InputError class="mt-2" :message="form.errors.first_name" />
                                            </div>
                                            <div class="flex-auto">
                                                <label for="last_name" class="mt-4 mb-2 block text-sm font-medium">
                                                    Last Name
                                                </label>
                                                <input type="text" id="last_name" v-model="form.last_name"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="Last Name" />
                                                <InputError class="mt-2" :message="form.errors.last_name" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="flex-auto">
                                                <label for="phone" class="mt-4 mb-2 block text-sm font-medium">
                                                    Phone
                                                </label>
                                                <input type="text" id="phone" v-model="form.phone"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="Phone" />
                                                <InputError class="mt-2" :message="form.errors.phone" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="flex-auto">
                                                <label for="address1" class="mt-4 mb-2 block text-sm font-medium">
                                                    Address 1
                                                </label>
                                                <input type="text" id="address1" v-model="form.address1"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="Address 1" />
                                                <InputError class="mt-2" :message="form.errors.address1" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="flex-auto">
                                                <label for="address2" class="mt-4 mb-2 block text-sm font-medium">
                                                    Address 2
                                                </label>
                                                <input type="text" id="address2" v-model="form.address2"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="Address 2" />
                                                <InputError class="mt-2" :message="form.errors.address2" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="flex-auto">
                                                <label for="city" class="mt-4 mb-2 block text-sm font-medium">
                                                    City
                                                </label>
                                                <input type="text" id="city" v-model="form.city"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="City" />
                                                <InputError class="mt-2" :message="form.errors.city" />
                                            </div>
                                            <div class="flex-auto">
                                                <label for="state" class="mt-4 mb-2 block text-sm font-medium">
                                                    State
                                                </label>
                                                <input type="text" id="state" v-model="form.state"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="State" />
                                                <InputError class="mt-2" :message="form.errors.state" />
                                            </div>
                                            <div class="flex-auto">
                                                <label for="zipcode" class="mt-4 mb-2 block text-sm font-medium">
                                                    Zipcode
                                                </label>
                                                <input type="text" id="zipcode" v-model="form.zipcode"
                                                    class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                                    placeholder="Zipcode" />
                                                <InputError class="mt-2" :message="form.errors.zipcode" />
                                            </div>
                                        </div>


                                        <!-- Total -->
                                        <div class="mt-6 border-t border-b py-2">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-900">Subtotal</p>
                                                <p class="font-semibold text-gray-900">${{ total_value }}</p>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-gray-900">Shipping</p>
                                                <p class="font-semibold text-gray-900">$0.00</p>
                                            </div>
                                        </div>
                                        <div class="mt-6 flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">Total</p>
                                            <p class="text-2xl font-semibold text-gray-900">${{ total_value }}</p>
                                        </div>
                                    </div>
                                    <button
                                        class="mt-4 mb-8 w-full rounded-md bg-orange-500 px-6 py-3 font-medium text-white">
                                        Place Order and Pass to Payment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
