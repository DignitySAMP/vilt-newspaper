<template>
    <AdminLayout active_tab="home">
        <Link :href="route('home')" class="flex h-fit w-fit">
            <AppButton :reverse="true" name="btn_return_home">
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
                    <AppButton name="btn_redirect_articles">
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
                    <AppButton name="btn_redirect_categories">
                        Manage Categories
                    </AppButton>
                </Link>

            </div>
            <div class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <span class="font-black">Back Office Dashboard</span>
                    <span class="text-sm">The back office is responsible for managing internal users.</span>
                </div>
                <Link :href="route('users.index')" class="flex h-fit w-fit">
                    <AppButton name="btn_redirect_users">
                        Manage Users
                    </AppButton>
                </Link>
            </div>

        </div>
    </AdminLayout>
</template>
<script setup lang="js">
    import { Link } from '@inertiajs/vue3';
    import AdminLayout from '@/layouts/AdminLayout.vue';
    import AppButton from '@/components/AppButton.vue'
</script>