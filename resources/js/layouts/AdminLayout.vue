<template>
    <header class="border-b-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8">

            <h1 class="text-center border-b-2 border-black pb-4 mb-4 text-3xl font-black py-2">
                Administration Dashboard
            </h1>
            
            <nav class="flex flex-wrap justify-center gap-8 text-sm font-semibold tracking-wide">
                <span class="hover:underline uppercase">Home</span>         
                <span class="hover:underline uppercase">Articles</span>
                <span class="hover:underline uppercase">Categories</span>
                <span class="hover:underline uppercase">Writers</span>
                <span class="hover:underline uppercase">Newsletter</span>
            </nav>
        </div>
    </header>

    <AppBody>
        <slot />
    </AppBody>
</template>
<script setup lang="js">
    import AppBody from '@/layouts/Partials/AppLayoutBody.vue';
</script>

