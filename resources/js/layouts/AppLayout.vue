<template>
    <div class="h-screen w-screen grid grid-rows-[auto_1fr_auto]">
        <AppHeader />
        <AppBody>
            <slot />
        </AppBody>
        <AppFooter />
    </div>
</template>
<script setup lang="js">
    import AppFooter from '@/layouts/Partials/AppLayoutFooter.vue';
    import AppHeader from '@/layouts/Partials/AppLayoutHeader.vue';
    import AppBody from '@/layouts/Partials/AppLayoutBody.vue';
</script>