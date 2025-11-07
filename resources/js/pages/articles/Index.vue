<template>
    <AdminLayout active_tab="articles">

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

        <IndexSearch/>

        <div class="flex flex-col gap-4">
            <div v-for="article in usePage().props.articles.data" :key="article.id" class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <span class="font-semibold">
                        {{ article.title }}
                    </span>
                    <div class="flex items-center gap-1 text-sm text-gray-600">
                        <span>Posted by</span>      
                        <span class="font-bold">
                            {{ article.author?.name }}
                        </span>
                        <span>under</span>               
                        <span class="font-bold">
                            {{ article.category?.title }}
                        </span>
                    </div>
                </div>

                <div class="flex w-full md:w-fit gap-2">

                    <Link :href="route('article.show', article.id)" class="size-full md:size-fit" view-transition>
                        <AppButton name="btn_article_show" :reverse="true">
                            View
                        </AppButton>
                    </Link>
                    <Link :href="route('article.edit', article.id)" class="size-full md:size-fit" view-transition>
                        <AppButton name="btn_article_edit">
                            Edit
                        </AppButton>
                    </Link>
                </div>
            </div>
        </div>

        <AppPagination :links="usePage().props.articles"/>

    </AdminLayout>
    
</template>
<script setup lang="js">
import { Link, usePage } from '@inertiajs/vue3';

import AdminLayout from '@/layouts/AdminLayout.vue';
import IndexSearch from '@/pages/articles/Partials/IndexSearch.vue';

import AppButton from '@/components/AppButton.vue'
import AppPagination from '@/components/AppPagination.vue'
</script>