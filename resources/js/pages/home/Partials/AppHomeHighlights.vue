<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div 
            v-for="article in props.articles" 
            :key="article.id" 
            class="border-2 border-black bg-white"
        >
        <img 
            :src="article.image" 
            :alt="article.title" 
            class="w-full h-64 object-cover border-b-2 border-black" 
        />
        
        <div class="p-6">
            <div class="text-xs font-bold mb-2 tracking-widest text-blue-600">
                {{ article.category }}
            </div>
            <h3 class="text-3xl font-bold leading-tight mb-3">
                {{ article.title }}
            </h3>
            <p class="text-sm leading-relaxed mb-3">
                {{ article.excerpt }}
            </p>
            <div class="flex justify-between items-center text-xs text-gray-600 pt-3 border-t">
                <span class="font-semibold">
                    {{ article.author }}
                </span>
                <span>
                    {{ article.date }}
                </span>
            </div>
        </div>
        </div>
    </div>
</template>
<script setup lang="js">
    const props = defineProps({
        articles: {
            type: Array,
            required: true
        }
    })
</script>