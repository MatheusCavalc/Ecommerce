<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Dropdown from '@/Components/Dropdown.vue';
import { ref } from 'vue';

const props = defineProps(['title', 'categories']);

const cart = ref(false)
const menu = ref(false)

const form = useForm({
    search: '',
})

const submit = () => {
    form.get(route('product.search'));
}
</script>

<template>
    <div>
        <Head :title="title" />

        <div class="min-h-screen bg-gray-100">
            <section class="lg:relative w-full fixed z-50">
                <!-- navbar -->
                <nav class="flex lg:fixed w-full justify-between text-white bg-black px-5 py-4 xl:px-16">
                    <div class="flex gap-10 lg:w-1/2">
                        <Link class="text-lg lg:text-3xl font-bold font-heading" :href="route('home')">
                        <!-- <img class="h-9" src="logo.png" alt="logo"> -->
                        Logo Here
                        </Link>
                        <!-- Search Bar-->
                        <div class="w-2/3 hidden lg:block">
                            <form @submit.prevent="submit" class="flex items-center">
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" v-model="form.search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5 rounded-lg"
                                        placeholder="Search">
                                </div>
                                <button type="submit"
                                    class="p-2.5 ml-1 text-sm font-medium text-gray-500 focus:ring-4 border-gray-300 focus:outline-none focus:ring-orange-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Header Icons -->
                    <div class="items-center gap-2 lg:gap-3 flex">
                        <template v-if="$page.props.user">
                            <Link class="hover:text-gray-200" :href="route('wishlist.index')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            </Link>

                            <div class="relative">
                                <Link :href="route('cart.index')">
                                <button @click="cart = !cart" class="flex items-center hover:text-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </button>
                                </Link>

                                <!--
                            <div v-show="cart" class="absolute z-40 top-8 right-2 p-2 bg-white text-black rounded-md">
                                <div class="lg:w-[430px] mx-auto my-1 text-sm font-bold text-left" id="submenu"
                                    v-for="cart in this.$page.props.userData.cart" :key="cart.id">
                                    <div class="flex text-black justify-between mb-2 border-b">
                                        <div class="">
                                            <img class="object-scale-down h-10 w-20" :src="`/storage/${cart.image}`"
                                                :alt="cart.name">
                                        </div>
                                        <p class="flex flex-col justify-between font-bold flex-grow text-sm w-20 h-14">
                                            {{ cart.name }}
                                        </p>
                                        <p class="text-center font-semibold text-sm">${{ cart.total_price }}</p>
                                    </div>
                                </div>

                                <Link :href="route('cart.index')">
                                <span class="p-2 text-black text-right rounded-md cursor-pointer hover:bg-slate-300">
                                    Cart
                                </span>
                                </Link>

                            </div>
                            -->
                            </div>

                            <!-- Sign In / Register -->
                            <Dropdown>
                                <template #trigger>
                                    <button class="flex items-center hover:text-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hover:text-gray-200"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </template>

                                <template #content>
                                    <div class="w-4/5 mx-auto my-1 text-sm font-bold text-left text-black" id="submenu">
                                        <Link :href="route('dashboard.index')">
                                        <h1 class="p-2 rounded-md cursor-pointer hover:bg-slate-300">
                                            My Orders
                                        </h1>
                                        </Link>
                                        <Link :href="route('logout')" method="post">
                                        <h1 class="p-2 rounded-md cursor-pointer hover:bg-slate-300">
                                            Logout
                                        </h1>
                                        </Link>
                                    </div>
                                </template>
                            </Dropdown>
                        </template>

                        <template v-else>
                            <Link :href="route('login')"
                                class="flex items-center text-sm lg:text-base px-4 py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-700">
                            Log in
                            </Link>

                            <Link :href="route('register')"
                                class="flex items-center text-sm lg:text-base px-4 py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-700">
                            Register</Link>
                        </template>


                        <button @click="menu = !menu" class="lg:hidden" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hover:text-gray-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </nav>
                <nav :class="{ 'md:block': menu, 'hidden md:block': !menu }"
                    class="lg:flex justify-between -mt-5 lg:mt-0 lg:pt-20 w-screen text-white bg-black z-40">
                    <div class="lg:flex lg:justify-center w-full px-5 lg:py-4 xl:px-12">
                        <!-- Nav Links -->
                        <ul
                            class="flex flex-col p-4 font-medium rounded-lg text-white md:p-0 bg-black md:flex-row md:space-x-8 md:mt-0 md:border-0">
                            <li class="py-2 lg:py-0">
                                <Link class="hover:text-gray-200" :href="route('home')">Home</Link>
                            </li>
                            <Dropdown>
                                <template #trigger>
                                    <li class="py-2 lg:py-0"><a class="hover:text-gray-200" href="#">Category</a></li>
                                </template>

                                <template #content>
                                    <div class="w-4/5 mx-auto my-1 text-sm font-bold text-left" id="submenu"
                                        v-for="category in this.$page.props.userData.categories" :key="category.id">
                                        <Link :href="route('category_view', category.slug)">
                                        <p class="p-2 text-black rounded-md cursor-pointer hover:bg-slate-300">
                                            {{ category.name }}
                                        </p>
                                        </Link>
                                    </div>
                                </template>
                            </Dropdown>

                            <li class="py-2 lg:py-0"><a class="hover:text-gray-200" href="#">Collections</a></li>
                            <li class="py-2 lg:py-0"><a class="hover:text-gray-200" href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- Responsive navbar -->
                </nav>

            </section>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>


            <footer class="p-4 text-white bg-black sm:p-6">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="https://flowbite.com/" class="flex items-center">
                            <span class="self-center text-2xl font-semibold whitespace-nowrap ">Logo Here</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <template v-if="$page.props.auth.user">
                            <div>
                                <h2 class="mb-6 text-sm font-semibold text-white uppercase">For Employees
                                </h2>
                                <ul class="text-gray-400">
                                    <li class="mb-4" v-if="$page.props.auth.user.admin">
                                        <a :href="route('admin')" class="hover:underline">Admin</a>
                                    </li>
                                </ul>
                            </div>
                        </template>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-white uppercase ">Follow us
                            </h2>
                            <ul class="text-gray-400">
                                <li class="mb-4">
                                    <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                                </li>

                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-white uppercase">Legal</h2>
                            <ul class="text-gray-400">
                                <li class="mb-4">
                                    <a href="#" class="hover:underline">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center">© 2023 All Rights Reserved.
                    </span>
                    <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Instagram page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Dribbbel account</span>
                        </a>
                    </div>
                </div>
            </footer>

        </div>
    </div>
</template>
