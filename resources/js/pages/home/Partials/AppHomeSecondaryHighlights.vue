<template>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div 
            v-for="article in props.articles" :key="article.id" 
            class="border-2 border-black bg-white p-6 shadow-md hover:shadow-xl transition-shadow"
        >
            <span class="text-xs font-bold mb-2 tracking-widest text-red-600">
                {{ article.category }}
            </span>
            
            <h3 class="text-2xl font-bold leading-tight mb-3">
                {{ article.title }}
            </h3>
            
            <img 
                v-if="article.image" 
                :src="article.image" :alt="article.title" 
                class="w-full h-48 object-cover mb-3 border border-black" 
            />
            
            <p class="text-sm leading-relaxed mb-3">
                {{ article.excerpt }}
            </p>
            
            <div class="flex justify-between items-center text-xs text-gray-600 border-t pt-3">
                <span>{{ article.author }}</span>
                <span>{{ article.readTime }}</span>
            </div>
        </div>
    </div>

</template>
<script setup lang="js">
    const props = defineProps({
        articles: {
            type: Array,
            required: true,
        }
    })

</script>