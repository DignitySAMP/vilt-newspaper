<template>
    <AppHeader/>
    <AppBody>
        <slot />
    </AppBody>
    <AppFooter/>
</template>
<script setup lang="js">
    import AppFooter from '@/layouts/Partials/AppLayoutFooter.vue';
    import AppHeader from '@/layouts/Partials/AppLayoutHeader.vue';
    import AppBody from '@/layouts/Partials/AppLayoutBody.vue';
</script>