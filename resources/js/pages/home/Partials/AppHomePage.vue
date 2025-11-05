<template>
    <div v-if="usePage().props.articles.data.length > 0" class="flex flex-col gap-8">
        <AppHomeBreakingNews  :article="usePage().props.articles.data[0]" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div v-for="article in usePage().props.articles.data.slice(1, 3)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-red-600"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div v-for="article in usePage().props.articles.data.slice(3, 6)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-red-600"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div v-for="article in usePage().props.articles.data.slice(6)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-green-600" :minimize="true"/>
            </div>
        </div>

        <AppPagination :links="usePage().props.articles"/>
    </div>
</template>
<script setup lang="js">
    import { usePage, Link } from '@inertiajs/vue3';

    import AppHomeBreakingNews from '@/pages/home/Partials/AppHomeBreakingNews.vue';
    import AppHomeArticleCard from '@/pages/home/Partials/AppHomeArticleCard.vue';
    import AppPagination from '@/components/AppPagination.vue';
</script>