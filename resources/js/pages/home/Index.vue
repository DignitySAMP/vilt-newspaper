<template>
    <AppLayout v-if="currentPage === 0">
        <div v-if="route().params?.category && route().params?.category !== null" class="px-4 py-2 w-full flex items-center justify-between border-2 border-amber-400 bg-amber-50">
            <span>
                Currently only showing articles under the <span class="lowercase font-bold underline">{{ route().params.category }}</span> category.
            </span>
            <Link :href="route('home')" class="font-bold underline uppercase text-xs cursor-pointer">
                Reset
            </Link>
        </div>

        <div v-if="usePage().props.articles.data.length > 0">
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

        </div>
        <div v-else class="min-h-190">
            <span>There are no articles under this category.</span>
        </div>
    </AppLayout>
    
    <AppLayout v-else-if="currentPage > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <AppHomeArticleCard v-for="article in usePage().props.articles.data" :article="article" :key="article.id"/>
        </div>
    </AppLayout>
</template>
<script setup lang="js">
    import { ref } from 'vue';
    import { usePage, Link } from '@inertiajs/vue3';

    import AppLayout from '@/layouts/AppLayout.vue';
    import AppHomeBreakingNews from '@/pages/home/Partials/AppHomeBreakingNews.vue';
    import AppHomeArticleCard from '@/pages/home/Partials/AppHomeArticleCard.vue';

    const currentPage = ref(0);
    // TODO: Improve the layout of this page, instead of multiple if statements for checking if there's any articles and checking the page, build a single flexible layout for this
  	
</script>