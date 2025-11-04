<template>
    <AppHomePage v-if="currentPage === 0"/>
    <AppListedPage v-else-if="currentPage > 0"/>
</template>
<script setup lang="js">
    import { ref } from 'vue';
    import AppHomePage from '@/pages/home/Partials/AppHomePage.vue';
    import AppListedPage from '@/pages/home/Partials/AppListedPage.vue';

    const currentPage = ref(0);
</script>