<template>
    <AppLayout>
        <div  v-if="usePage().props.articles.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <AppHomeArticleCard 
                v-for="article in usePage().props.articles.data" 
                :article="article" 
                :key="article.id"
            />
        </div>
        <div v-else class="min-h-190">
            <span>There are no articles under this category.</span>
        </div>
    </AppLayout>
</template>
<script setup lang="js">
    import { usePage } from '@inertiajs/vue3';

    import AppLayout from '@/layouts/AppLayout.vue';
    import AppHomeArticleCard from '@/pages/home/Partials/AppHomeArticleCard.vue';

</script>