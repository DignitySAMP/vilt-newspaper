<template>
    <AdminLayout active_tab="home">
        <Link :href="route('home')" class="flex h-fit w-fit">
            <AppButton :reverse="true">
                Back to website
            </AppButton>
        </Link>
        <div class="flex flex-col gap-4">

            <div class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <span class="font-black">Writer Dashboard</span>
                    <span class="text-sm">The writer is responsible for writing articles.</span>
                </div>

                <Link :href="route('article.index')" class="flex h-fit w-fit">
                    <AppButton>
                        Manage Articles
                    </AppButton>
                </Link>

            </div>
            <div class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <span class="font-black">Publisher Dashboard</span>
                    <span class="text-sm">The writer is responsible for publishing categories.</span>
                </div>

                <Link :href="route('category.index')" class="flex h-fit w-fit">
                    <AppButton>
                        Manage Categories
                    </AppButton>
                </Link>

            </div>
            <div class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <span class="font-black">Administrator Dashboard</span>
                    <span class="text-sm">The administrator is responsible for managing internal users.</span>
                </div>
                <div class="flex h-fit w-fit">
                    <AppButton>
                        Manage Users
                    </AppButton>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>
<script setup lang="js">
    import { Link } from '@inertiajs/vue3';
    import AdminLayout from '@/layouts/AdminLayout.vue';
    import AppButton from '@/components/AppButton.vue'
</script>