<template>
    <div class="flex flex-col gap-6">        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div 
                v-for="article in articles.slice(0, itemsPerPage)" :key="article.id" 
                class="bg-white border-2 border-black shadow-md hover:shadow-xl transition-shadow"
            >
                <img 
                    :src="article.image" 
                    :alt="article.title" 
                    class="w-full h-48 object-cover border-b-2 border-black" 
                />
                
                <div class="p-4">
                    <span class="text-xs font-bold mb-2 tracking-widest text-gray-600">
                        {{ article.category }}
                    </span>

                    <h4 class="text-lg font-bold leading-tight mb-2">{{ article.title }}</h4>
                    <div class="text-xs text-gray-600 flex justify-between items-center pt-2 border-t">
                        <span>{{ article.author }}</span>
                        <span>{{ article.readTime }}</span>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

</template>
<script setup lang="js">

    const props = defineProps({
        articles: {
            type: Object,
            required: true
        }
    });

    const itemsPerPage = 4;
</script>