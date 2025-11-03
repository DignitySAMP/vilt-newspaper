<template>
    <AppLayout>
        <Link :href="route('home')" view-transition>
            <AppButton :reverse="true" name="btn_home">
                Home
            </AppButton>
        </Link>

        <article class="bg-white border-4 border-black">

            <img :src="article.image" alt="" class="w-full object-cover h-96 border-b-4 border-black"/>

            <header class="w-full justify-between flex gap-4 items-center p-6 pb-0  text-gray-500">
                <div class="w-full flex gap-1">
                    <span>Written by</span>
                    <span>{{ article.author.name }}</span>
                </div>
                <div class="flex gap-2 w-full items-center justify-end">
                    <span>{{ new Date(article.created_at).toDateString() }}</span>
                    <AppSeparator/>
                    <span>{{ article.category?.title ?? 'General'}}</span>
                </div>
            </header>

            <main class="w-full h-full p-6 pt-3 flex flex-col gap-4">
                <h1 class="p-w-full text-2xl font-bold">{{ article.title }}</h1>
                <div class="prose max-w-none whitespace-pre-line">{{ article.content }}</div>
            </main>
        </article>
    </AppLayout>
</template>
<script setup lang="js">
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import AppSeparator from '@/components/AppSeparator.vue'
import AppButton from '@/components/AppButton.vue';

const props = defineProps({
    article: {
        type: Object,
        required: true
    }
});
</script>

