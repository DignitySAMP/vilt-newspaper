<template>
    <div class="container mx-auto max-w-3xl">
        <header class="mt-4 w-full flex justify-center">
            <AppLogo/>
        </header>

        <main class="mt-8 border-4 border-black bg-white p-8 shadow-lg flex flex-col gap-4">
            <slot/>
        </main>
    </div>
</template>
<script setup lang="js">
    import AppLogo from '@/components/AppLogo.vue';
</script>
