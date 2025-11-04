<template>
    <AdminLayout active_tab="category">
        <span v-if="usePage().props.flash?.message" class="w-full px-4 py-2 bg-amber-100 border-4 border-amber-300 text-amber-700">
            {{ usePage().props.flash.message }}
        </span>

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Categories</h1>
            <Link :href="route('category.create')" class="hover:underline" view-transition>
                <AppButton name="btn_category_create">
                    Create New Category
                </AppButton>
            </Link>
        </div>

        <div class="flex flex-col gap-4">
            <div v-for="category in categories" :key="category.id" class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">

                <div class="flex flex-col">
                    
                    <span class="font-semibold">
                        {{ category.title }}
                    </span>
                    <span class="text-gray-600">
                        {{ category.description }}
                    </span>
                </div>

                <div class="flex w-full md:w-fit gap-2">

                    <Link :href="route('category.show', category.id)" class="size-full md:size-fit" view-transition>
                        <AppButton name="btn_category_show" :reverse="true">
                            View
                        </AppButton>
                    </Link>
                    <Link :href="route('category.edit', category.id)" class="size-full md:size-fit" view-transition>
                        <AppButton name="btn_category_edit">
                            Edit
                        </AppButton>
                    </Link>
                </div>
            </div>
        </div>

    </AdminLayout>
    
</template>
<script setup lang="js">
import AdminLayout from '@/layouts/AdminLayout.vue';
import AppButton from '@/components/AppButton.vue'
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    categories: {
        type: Array,
        required: true
    }
});
</script>