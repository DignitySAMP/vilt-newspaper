<template>
    <AdminLayout>

        <span v-if="usePage().props.flash?.message" class="w-full px-4 py-2 bg-amber-100 border-4 border-amber-300 text-amber-700">
            {{ usePage().props.flash.message }}
        </span>

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Articles</h1>
            <Link :href="route('article.create')" class="hover:underline" view-transition>
                <AppButton name="btn_article_create">
                    Create New Article
                </AppButton>
            </Link>
        </div>

        <div class="flex flex-col gap-4">
            <div v-for="article in articles" :key="article.id" class="flex justify-between border-4 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <span class="font-semibold">
                        {{ article.title }}
                    </span>
                    <span class="text-sm text-gray-600">
                        {{ article.category?.title }}
                    </span>
                </div>

                <div class="flex  gap-2">

                    <Link :href="route('article.show', article.id)" class="h-fit w-fit" view-transition>
                        <AppButton name="btn_article_show" :reverse="true">
                            View
                        </AppButton>
                    </Link>
                    <Link :href="route('article.edit', article.id)" class="h-fit w-fit" view-transition>
                        <AppButton name="btn_article_edit">
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
    articles: {
        type: Array,
        required: true
    }
});
</script>