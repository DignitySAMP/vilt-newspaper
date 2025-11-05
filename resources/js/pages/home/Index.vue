<template>
    <AppHomePage v-if="currentPage === 1"/>
    <AppListedPage v-else-if="currentPage > 1"/>
</template>
<script setup lang="js">
    import { usePage } from '@inertiajs/vue3';
    import AppHomePage from '@/pages/home/Partials/AppHomePage.vue';
    import AppListedPage from '@/pages/home/Partials/AppListedPage.vue';

    const currentPage = usePage().props.articles.current_page;
</script>