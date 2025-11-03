<template>
    <AppLayout v-if="currentPage === 0">
        <AppHomeBreakingNews :article="usePage().props.articles[0]" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div v-for="article in usePage().props.articles.slice(1, 3)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-red-600"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div v-for="article in usePage().props.articles.slice(3, 6)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-red-600"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div v-for="article in usePage().props.articles.slice(6)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-green-600" :minimize="true"/>
            </div>
        </div>

        <div class="border-t-4 border-black pt-6 flex justify-center items-center gap-2">
            <button class="bg-black text-white px-4 py-2 font-bold transition duration-300 opacity-40 cursor-not-allowed">
                ← PREV
            </button>
            <div class="flex flex-wrap gap-2">
                <button 
                    v-for="page, index in 16" :key="page"
                    :class="index === 0 ? 'bg-black text-white' : 'bg-white text-black border-2 border-black hover:bg-neutral-200 cursor-pointer'"
                    class="w-10 h-10 font-bold transition duration-300"
                >
                    {{ page }}
                </button>
            </div>
            <button class="bg-black text-white px-4 py-2 font-bold transition duration-300 hover:bg-neutral-700 cursor-pointer">
                NEXT →
            </button>
        </div>

    </AppLayout>
    <AppLayout v-else-if="currentPage > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <AppHomeArticleCard v-for="article in usePage().props.articles" :article="article" :key="article.id"/>
        </div>
    </AppLayout>

</template>
<script setup lang="js">
    import { ref } from 'vue';
    import { usePage } from '@inertiajs/vue3';

    import AppLayout from '@/layouts/AppLayout.vue';
    import AppHomeBreakingNews from '@/pages/home/Partials/AppHomeBreakingNews.vue';
    import AppHomeArticleCard from '@/pages/home/Partials/AppHomeArticleCard.vue';

    const currentPage = ref(0);
  	
</script>