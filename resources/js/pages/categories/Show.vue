<template>
    <AdminLayout active_tab="category">
        <Link :href="route('category.index')" class="size-full md:size-fit" view-transition>
            <AppButton name="btn_category_index" :reverse="true">
                Back
            </AppButton>
        </Link>
        
        <div class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">
            <div class="flex flex-col gap-2">
                <span class="font-semibold">
                    {{ usePage().props.category.title }}
                </span>
                <span class="text-sm text-gray-600">
                    {{ usePage().props.category.description }}
                </span>
            </div>
            <div>
                <Link :href="route('category.edit', usePage().props.category.id)" class="size-full md:size-fit" view-transition>
                    <AppButton name="btn_category_edit">
                        Edit
                    </AppButton>
                </Link>
            </div>
        </div>

        <div v-for="article in usePage().props.category.articles">

            <div class="flex flex-col items-center gap-4 md:flex-row justify-between border-2 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <span class="font-semibold">
                        {{ article.title }}
                    </span>
                    <span class="text-sm text-gray-600">
                        {{ article.summary }}
                    </span>
                </div>
                <div>
                    <Link :href="route('article.show', article.id)" class="size-full md:size-fit" view-transition>
                        <AppButton name="btn_article_show">
                            Show
                        </AppButton>
                    </Link>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
<script setup lang="js">
    import { usePage, Link } from '@inertiajs/vue3';
    import AdminLayout from '@/layouts/AdminLayout.vue';
    import AppButton from '@/components/AppButton.vue'
</script>