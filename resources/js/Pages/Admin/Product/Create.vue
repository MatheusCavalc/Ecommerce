<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps(['categories', 'user_id'])

const form = useForm({
    name: '',
    category_id: '',
    image: '',
    description: '',
    price: '',
    published: false,
    created_by: props.user_id
})

const submit = () => {
    form.post(route('admin.products.store'));
}
</script>

<template>

    <Head title="Admin - New Category" />

    <AdminLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <h1 class="text-3xl">Create New Category</h1>

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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option v-for="category in categories" :value="category.id" :key="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.category_id" />
                            </div>

                            <div class="mb-3">
                                <InputLabel for="image" value="Image"
                                    class="block mb-2 text-sm font-medium text-gray-900" />
                                <TextInput id="image" type="file" @input="form.image = $event.target.files[0]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
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
