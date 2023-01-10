<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Table from '@/Components/Table.vue';
import TData from '@/Components/TData.vue';
import THead from '@/Components/THead.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const props = defineProps(['products']);

const dialog = ref('')

const modal = () => {
    dialog.value = false
}

modal()
</script>

<template>

    <Head title="Admin - Products" />

    <AdminLayout>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="mb-2 flex justify-end">
                        <Link :href="route('admin.products.create')">
                        <PrimaryButton>
                            New Product
                        </PrimaryButton>
                        </Link>
                    </div>

                    <Table :paginator="products">
                        <template #headColumns>
                            <THead label="Name" />
                            <THead label="Category" />
                            <THead label="Price" />
                            <THead label="Status" />
                            <THead label="Edit" />
                        </template>
                        <template #tableRows>
                            <tr v-for="product in products" :key="product.id"
                                class="bg-white border-b hover:bg-gray-200">
                                <TData type="first">
                                    {{ product.name }}
                                </TData>

                                <TData type="first">
                                    {{ product.category.name }}
                                </TData>

                                <TData type="first">
                                    {{ product.price }}
                                </TData>

                                <TData type="first">
                                    <p v-if="product.published == 1">Published</p>
                                    <p v-else>Not Published</p>
                                </TData>

                                <TData type="normal">
                                    <Link :href="route('admin.products.edit', product.id)">
                                    <PrimaryButton>
                                        Edit
                                    </PrimaryButton>
                                    </Link>

                                    <DangerButton class="ml-1" @click="dialog = true">
                                        Delete
                                        <ConfirmModal :dialog="dialog" message="Are you sure?"
                                            :url="route('admin.products.destroy', product.id)">
                                        </ConfirmModal>
                                    </DangerButton>
                                </TData>
                            </tr>
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AdminLayout>

</template>
