<template>
    <AppLayout>
        <AppHomeSearch/>
        <AppHomePage v-if="currentPage === 1"/>
        <AppListedPage v-else-if="currentPage > 1"/>
        <div v-if="usePage().props.articles.data.length < 1" class="w-full min-h-190">
            <span>No articles found.</span>
        </div>

        <AppNewsletter/>
    </AppLayout>
</template>
<script setup lang="js">
    import { usePage } from '@inertiajs/vue3';

    import AppLayout from '@/layouts/AppLayout.vue';
    import AppHomeSearch from '@/pages/home/Partials/AppHomeSearch.vue';
    import AppHomePage from '@/pages/home/Partials/AppHomePage.vue';
    import AppListedPage from '@/pages/home/Partials/AppListedPage.vue';
    import AppNewsletter from '@/components/AppNewsletter.vue';

    const currentPage = usePage().props.articles.current_page;
</script>