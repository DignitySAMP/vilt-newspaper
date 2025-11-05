<template>
    <AppLayout>
        <div v-if="route().params?.category && route().params?.category !== null" class="px-4 py-2 w-full flex items-center justify-between border-2 border-amber-400 bg-amber-50">
            <span>
                Currently only showing articles under the <span class="lowercase font-bold underline">{{ route().params.category }}</span> category.
            </span>
            <Link :href="route('home')" class="font-bold underline uppercase text-xs cursor-pointer">
                Reset
            </Link>
        </div>

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
        <div v-else class="min-h-190">
            <span>There are no articles under this category.</span>
        </div>
    </AppLayout>
</template>
<script setup lang="js">
    import { usePage, Link } from '@inertiajs/vue3';

    import AppLayout from '@/layouts/AppLayout.vue';
    import AppHomeBreakingNews from '@/pages/home/Partials/AppHomeBreakingNews.vue';
    import AppHomeArticleCard from '@/pages/home/Partials/AppHomeArticleCard.vue';
    import AppPagination from '@/components/AppPagination.vue';
</script>