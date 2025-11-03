<template>
    <div class="border-2 border-black bg-white shadow-md hover:shadow-xl transition-shadow">
        <img 
            :src="props.article.image" :alt="props.article.title" 
            class="w-full object-cover border-b-2 border-black" 
            :class="props.minimize ? 'h-32' : 'h-64'"
        />
        
        <div class="flex flex-col" :class="props.minimize ? 'p-4 gap-1' : 'p-6 gap-3'">
            <div class="text-xs font-bold tracking-widest" :class="props.category_color">
                {{ props.article.category }}
            </div>
            <h3 class="font-bold leading-tight truncate" :class="props.minimize ? 'text-lg' : 'text-2xl'">
                {{ props.article.title }}
            </h3>
            <p v-if="!props.minimize && props.article.summary" class="text-sm leading-relaxed min-h-32">
                {{ props.article.summary }}
            </p>
            <div class="flex justify-between items-center text-xs text-gray-600 pt-3 border-t">
                <span class="font-semibold">
                    {{ props.article.author }}
                </span>
                <span>
                    {{ props.article.date }}
                </span>
                <span v-if="props.minimize">
                    {{ props.article.readTime }}
                </span>
            </div>
        </div>
    </div>
    
</template>
<script setup lang="js">
    const props = defineProps({
        article: {
            type: Object,
            required: true
        },
        category_color: {
            type: String,
            required: false,
            default: "text-blue-600"
        },
        minimize: {
            type: Boolean,
            required: false,
            default: false,
        }
    })
</script>
