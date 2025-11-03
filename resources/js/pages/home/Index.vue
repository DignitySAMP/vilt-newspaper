<template>
    <AppLayout v-if="currentPage === 0">
        <AppHomeBreakingNews :article="tmpArticles[0]" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div v-for="article in tmpArticles.slice(1, 3)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-red-600"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div v-for="article in tmpArticles.slice(3, 6)" :key="article.id">
                <AppHomeArticleCard :article="article" category_color="text-red-600"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div v-for="article in tmpArticles.slice(6)" :key="article.id">
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
            <AppHomeArticleCard v-for="article in tmpArticles" :article="article" :key="article.id"/>
        </div>
    </AppLayout>

</template>
<script setup lang="js">
    import { ref } from 'vue';
    import AppLayout from '@/layouts/AppLayout.vue';
    import AppHomeBreakingNews from '@/pages/home/Partials/AppHomeBreakingNews.vue';
    import AppHomeArticleCard from '@/pages/home/Partials/AppHomeArticleCard.vue';

    const currentPage = ref(0);
  	const tmpArticles = ref([ // placeholder
        {
            id: 1,
            title: "Revolutionary AI System Transforms Software Development",
            summary: "In a groundbreaking development, researchers have unveiled a new artificial intelligence system that promises to revolutionize how we approach software development. The system demonstrates unprecedented capabilities in understanding context and generating solutions.",
            author: "Sarah Mitchell",
            date: "Nov 3, 2025",
            readTime: "5 min",
            category: "TECHNOLOGY",
            image: "https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=600&fit=crop"
        },
        {
            id: 2,
            title: "Global Climate Summit Reaches Historic Agreement",
            summary: "World leaders have signed a landmark treaty committing to aggressive carbon reduction targets.",
            author: "James Chen",
            date: "Nov 2, 2025",
            readTime: "4 min",
            category: "WORLD",
            image: "https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?w=400&h=300&fit=crop"
        },
        {
            id: 3,
            title: "Market Volatility Continues Amid Economic Uncertainty",
            summary: "Stock markets experienced significant fluctuations this week as investors grapple with mixed economic signals.",
            author: "Emily Rodriguez",
            date: "Nov 2, 2025",
            readTime: "3 min",
            category: "BUSINESS",
            image: "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=400&h=300&fit=crop"
        },
        {
            id: 4,
            title: "Archaeological Discovery Rewrites Ancient History",
            summary: "A team of archaeologists has unearthed artifacts that challenge our understanding of early civilizations.",
            author: "Dr. Michael Park",
            date: "Nov 1, 2025",
            readTime: "6 min",
            category: "CULTURE",
            image: "https://images.unsplash.com/photo-1594818379496-da1e345b0ded?w=400&h=300&fit=crop"
        },
        {
            id: 5,
            title: "Space Agency Announces Ambitious Mars Colony Timeline",
            summary: "Plans for establishing a permanent human presence on Mars have been accelerated, with the first crewed mission targeted for 2035. The announcement marks a new era in space exploration.",
            author: "Lisa Yamamoto",
            date: "Oct 31, 2025",
            readTime: "7 min",
            category: "SCIENCE",
            image: "https://images.unsplash.com/photo-1614728894747-a83421e2b9c9?w=600&h=400&fit=crop"
        },
        {
            id: 6,
            title: "Renaissance of Urban Green Spaces Transforms Cities",
            summary: "Metropolitan areas worldwide are embracing innovative approaches to urban planning, creating sustainable green spaces that improve quality of life and combat climate change effects.",
            author: "Marcus Thompson",
            date: "Oct 30, 2025",
            readTime: "5 min",
            category: "ENVIRONMENT",
            image: "https://images.unsplash.com/photo-1518005068251-37900150dfca?w=600&h=400&fit=crop"
        },
        {
            id: 7,
            title: "Quantum Computing Makes Commercial Debut",
            summary: "",
            author: "Dr. Rachel Kim",
            date: "",
            readTime: "4 min",
            category: "TECHNOLOGY",
            image: "https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=400&h=300&fit=crop"
        },
        {
            id: 8,
            title: "Ocean Conservation Efforts Show Promising Results",
            summary: "",
            author: "Thomas Wright",
            date: "",
            readTime: "5 min",
            category: "ENVIRONMENT",
            image: "https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop"
        },
        {
            id: 9,
            title: "Digital Art Revolution Transforms Museums",
            summary: "",
            author: "Isabella Costa",
            date: "",
            readTime: "3 min",
            category: "CULTURE",
            image: "https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=400&h=300&fit=crop"
        },
        {
            id: 10,
            title: "New Economic Policy Sparks Debate",
            summary: "",
            author: "William Foster",
            date: "",
            readTime: "6 min",
            category: "BUSINESS",
            image: "https://images.unsplash.com/photo-1579532537598-459ecdaf39cc?w=400&h=300&fit=crop"
        }
    ]);
</script>