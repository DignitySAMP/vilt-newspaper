<template>
    <Link :href="route('article.show', props.article.id)" view-transition>
             
        <div class="border-2 border-black bg-white shadow-md hover:shadow-xl transition-shadow">
            <img 
                v-if="props.article.image_url"
                :src="props.article.image_url" :alt="props.article.title" 
                class="w-full object-cover border-b-2 border-black" 
                :class="props.minimize ? 'h-32' : 'h-64'"
            />
            
            <div class="flex flex-col" :class="props.minimize ? 'p-4 gap-1' : 'p-6 gap-3'">
                <Link :href="route('home', {
                    'category': props.article.category.title.trim() ?? null
                })" class="text-xs font-bold tracking-widest uppercase hover:underline" :class="props.category_color">
                    {{ props.article.category.title ?? 'General' }}
                </Link>
                <h3 class="font-bold leading-tight truncate" :class="props.minimize ? 'text-lg' : 'text-2xl'">
                    {{ props.article.title }}
                </h3>
                <p v-if="!props.minimize && props.article.summary" class="text-sm leading-relaxed min-h-25">
                    {{ truncateSummary }}
                </p>
                <div class="flex justify-between items-center text-xs text-gray-600 pt-3 border-t">
                    <span class="font-semibold">
                        {{ props.article.author.name }}
                    </span>
                    <span>
                        {{ new Date(props.article.created_at).toDateString() }}
                    </span>
                    <span v-if="props.minimize">
                        {{ props.article.read_time }} min read
                    </span>
                </div>
            </div>
        </div>
    </Link>
</template>

<script setup lang="js">
    import { Link } from '@inertiajs/vue3';
    import { computed } from 'vue';


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
    });

    const truncateSummary = computed(() => {
        const summary = props.article.summary || ''
        return summary.length > 128 ? summary.slice(0, 128) + '…' : summary
    })
</script>
