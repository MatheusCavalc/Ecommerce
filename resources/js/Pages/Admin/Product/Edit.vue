<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps(['product', 'categories', 'image', 'user_id'])

const form = useForm({
    name: props.product.name,
    category_id: props.product.category_id,
    image: props.product.image,
    description: props.product.description,
    price: props.product.price,
    on_sale: props.product.on_sale,
    sale_price: props.product.sale_price,
    published: props.product.published,
    updated_by: props.user_id
})

const submit = () => {
    Inertia.post(`/admin/products/${props.product.id}`, {
        _method: 'PUT',
        name: form.name,
        category_id: form.category_id,
        image: form.image,
        description: form.description,
        price: form.price,
        on_sale: form.on_sale,
        sale_price: form.sale_price,
        published: form.published,
        updated_by: form.updated_by
    })
}

</script>

<template>

    <Head title="Admin - Edit Product" />

    <AdminLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <h1 class="text-3xl">Edit Product</h1>

                        <form @submit.prevent="submit">

                            <div class="mb-3">
                                <InputLabel for="name" value="Name"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <TextInput id="name" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    v-model="form.name" required />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mb-3">
                                <InputLabel for="category_id" value="Category"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <select v-model="form.category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option v-for="category in categories" :value="category.id" :key="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.category_id" />
                            </div>

                            <div class="mb-3">
                                <InputLabel for="image" value="Image"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <div class="m-2 p-2">
                                    <img :src="image" class="w-32 h-32">
                                </div>
                                <TextInput id="image" type="file" @input="form.image = $event.target.files[0]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                                <InputError class="mt-2" :message="form.errors.image" />
                            </div>

                            <div class="mb-3">
                                <InputLabel for="description" value="Description"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <TextInput id="description" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    v-model="form.description" required />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="mb-3">
                                <InputLabel for="price" value="Price"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <TextInput id="price" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    v-model="form.price" required />
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div class="flex flex-wrap">
                                <div class="my-4 w-full md:w-1/5">
                                    <label class="flex items-center">
                                        <Checkbox v-model:checked="form.on_sale" name="on_sale" />
                                        <span class="ml-2 text-sm text-gray-600">On Sale</span>
                                    </label>
                                </div>

                                <div class="mb-3 w-full md:w-4/5">
                                    <InputLabel for="sale_price" value="Sale Price"
                                        class="block mb-2 text-sm font-medium text-gray-900" />
                                    <TextInput id="sale_price" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        v-model="form.sale_price" />
                                    <InputError class="mt-2" :message="form.errors.sale_price" />
                                </div>
                            </div>

                            <div class="block my-4">
                                <label class="flex items-center">
                                    <Checkbox v-model:checked="form.published" name="published" />
                                    <span class="ml-2 text-sm text-gray-600">Published</span>
                                </label>
                            </div>

                            <PrimaryButton
                                class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
