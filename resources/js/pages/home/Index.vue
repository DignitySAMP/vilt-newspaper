<template>
   
   <AppLayout>
    <AppHomeBreakingNews :article="tmpArticles[0]"/>
    <AppHomeHighlights :articles="tmpArticles.slice(1,3)"/>
   </AppLayout>
</template>
<script setup lang="js">
    import { ref } from 'vue';
    import AppLayout from '@/layouts/AppLayout.vue';
    import AppHomeBreakingNews from '@/pages/home/Partials/AppHomeBreakingNews.vue';
    import AppHomeHighlights from '@/pages/home/Partials/AppHomeHighlights.vue';

  	const tmpArticles = ref([ // placeholder
        {
            id: 1,
            title: "Revolutionary AI System Transforms Software Development",
            excerpt: "In a groundbreaking development, researchers have unveiled a new artificial intelligence system that promises to revolutionize how we approach software development. The system demonstrates unprecedented capabilities in understanding context and generating solutions.",
            author: "Sarah Mitchell",
            date: "Nov 3, 2025",
            readTime: "5 min",
            category: "TECHNOLOGY",
            image: "https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=600&fit=crop"
        },
        {
            id: 2,
            title: "Global Climate Summit Reaches Historic Agreement",
            excerpt: "World leaders have signed a landmark treaty committing to aggressive carbon reduction targets.",
            author: "James Chen",
            date: "Nov 2, 2025",
            readTime: "4 min",
            category: "WORLD",
            image: "https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?w=400&h=300&fit=crop"
        },
        {
            id: 3,
            title: "Market Volatility Continues Amid Economic Uncertainty",
            excerpt: "Stock markets experienced significant fluctuations this week as investors grapple with mixed economic signals.",
            author: "Emily Rodriguez",
            date: "Nov 2, 2025",
            readTime: "3 min",
            category: "BUSINESS",
            image: "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=400&h=300&fit=crop"
        },
        {
            id: 4,
            title: "Archaeological Discovery Rewrites Ancient History",
            excerpt: "A team of archaeologists has unearthed artifacts that challenge our understanding of early civilizations.",
            author: "Dr. Michael Park",
            date: "Nov 1, 2025",
            readTime: "6 min",
            category: "CULTURE",
            image: "https://images.unsplash.com/photo-1594818379496-da1e345b0ded?w=400&h=300&fit=crop"
        },
        {
            id: 5,
            title: "Space Agency Announces Ambitious Mars Colony Timeline",
            excerpt: "Plans for establishing a permanent human presence on Mars have been accelerated, with the first crewed mission targeted for 2035. The announcement marks a new era in space exploration.",
            author: "Lisa Yamamoto",
            date: "Oct 31, 2025",
            readTime: "7 min",
            category: "SCIENCE",
            image: "https://images.unsplash.com/photo-1614728894747-a83421e2b9c9?w=600&h=400&fit=crop"
        },
        {
            id: 6,
            title: "Renaissance of Urban Green Spaces Transforms Cities",
            excerpt: "Metropolitan areas worldwide are embracing innovative approaches to urban planning, creating sustainable green spaces that improve quality of life and combat climate change effects.",
            author: "Marcus Thompson",
            date: "Oct 30, 2025",
            readTime: "5 min",
            category: "ENVIRONMENT",
            image: "https://images.unsplash.com/photo-1518005068251-37900150dfca?w=600&h=400&fit=crop"
        }
    ]);
</script>