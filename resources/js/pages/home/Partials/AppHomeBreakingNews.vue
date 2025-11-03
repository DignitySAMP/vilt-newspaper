<template>

    <article class="border-4 border-black bg-white p-8 shadow-lg flex flex-col gap-4">
        <span class="text-xs font-bold tracking-widest">
            BREAKING NEWS
        </span>
        <h2 class="text-4xl font-black leading-tight">
            {{ props.article.title }}
        </h2>
        <div class="flex items-center gap-4 text-sm pb-4 border-b border-gray-300">
            <div class="flex items-center gap-1">
                <span class="font-semibold">By</span> 
                <span>{{ props.article.author.name }}</span>
            </div>
            <AppSeparator/>
            <span>{{ new Date(props.article.created_at).toDateString() }}</span>
            <AppSeparator/>
            <span>{{ props.article.read_time }} min read</span>
        </div>
        <img 
            :src="props.article.image" 
            :alt="props.article.title" 
            class="w-full h-48 object-center md:h-96 md:object-cover border-2 border-black" 
        />
        <p class="text-lg leading-relaxed">
            {{ props.article.summary }}
        </p>

        <Link :href="route('article.show', props.article.id)" view-transition>
            <AppButton name="btn_read_more">
                Read Full Story
            </AppButton>
        </Link>
    </article>
</template>
<script setup lang="js">
    import { Link } from '@inertiajs/vue3';
    import AppButton from '@/components/AppButton.vue' // TODO: Make AppButtonLink for viewing threads
    import AppSeparator from '@/components/AppSeparator.vue';

    const props = defineProps({
        article: {
            type: Object,
            required: true
        }
    })
</script>