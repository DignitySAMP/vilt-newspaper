<template>

    <div  v-if="usePage().props.articles.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <AppHomeArticleCard 
            v-for="article in usePage().props.articles.data" 
            :article="article" 
            :key="article.id"
        />
    </div>

    <AppPagination :links="usePage().props.articles"/>

</template>
<script setup lang="js">
    import { usePage } from '@inertiajs/vue3';

    import AppHomeArticleCard from '@/pages/home/Partials/AppHomeArticleCard.vue';
    import AppPagination from '@/components/AppPagination.vue'
</script>