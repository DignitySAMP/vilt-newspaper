<template>
    <AppLayout>
        <Link :href="route('home')" view-transition>
            <AppButton :reverse="true" name="btn_home">
                Home
            </AppButton>
        </Link>

        <article class="bg-white border-4 border-black">

            <img 
                v-if="usePage().props.article.image" 
                :src="usePage().props.article.image" 
                alt="" 
                class="w-full object-cover h-96 border-b-4 border-black"
            />

            <header class="w-full justify-between flex flex-wrap md:flex-nowrap gap-4 items-center p-6 pb-0  text-gray-500">
                <div class="w-full flex gap-1">
                    <span>Written by</span>
                    <span>{{ usePage().props.article.author.name }}</span>
                </div>
                <div class="flex gap-2 w-full items-center md:justify-end">
                    <span>{{ new Date(usePage().props.article.created_at).toDateString() }}</span>
                    <AppSeparator/>
                    <Link :href="route('home', {
                        'category': usePage().props.article.category?.title.trim() ?? null
                    })" class="text-xs font-bold tracking-widest uppercase text-blue-500 hover:underline">
                        {{ usePage().props.article.category?.title ?? 'General' }}
                    </Link>
                </div>
            </header>

            <main class="w-full h-full p-6 pt-3 flex flex-col gap-4">
                <h1 class="p-w-full text-2xl font-bold">{{ usePage().props.article.title }}</h1>
                <div class="prose max-w-none whitespace-pre-line">{{ usePage().props.article.content }}</div>
            </main>
        </article>

        <ListComments :comments="usePage().props.comments"/>
    </AppLayout>
</template>
<script setup lang="js">
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import AppSeparator from '@/components/AppSeparator.vue'
import AppButton from '@/components/AppButton.vue';
import ListComments from '@/pages/comments/Index.vue';
</script>

