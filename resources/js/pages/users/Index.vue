<template>
    <AdminLayout active_tab="users">
        <span v-if="usePage().props.flash?.message" class="w-full px-4 py-2 bg-amber-100 border-4 border-amber-300 text-amber-700">
            {{ usePage().props.flash.message }}
        </span>

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Users</h1>
            <Link :href="route('users.create')" class="hover:underline" view-transition>
                <AppButton name="btn_user_create">
                    Create New User
                </AppButton>
            </Link>
        </div>

        <IndexSearch/>

        <div class="flex flex-col gap-4">
            <div v-for="user in usePage().props.users.data" :key="user.id" class="flex flex-col md:flex-row justify-between border-4 border-black bg-white p-4">
                <div class="flex flex-col gap-2">
                    <div class="flex gap-2 items-center">
                        <span class="font-semibold">
                            {{ user.name }}
                        </span>
                        <div v-if="user.roles.length > 0" class="flex gap-1 text-xs text-gray-600">
                            (
                            <div v-for="role, index in user.roles">
                                <span>{{ role.name ?? '' }}</span>
                                <span v-if="index < user.roles.length - 1">
                                    |
                                </span>
                            </div>
                            )
                        </div>
                        <span class="text-xs" :class="user.newsletter ? 'text-green-600' : 'text-red-600'">
                            {{ user.newsletter ? 'Subscribed to the newsletter' : 'Not subscribed to the newsletter' }}
                        </span>
                    </div>
                    <span class="text-sm text-gray-600">
                        {{ user.email }}
                    </span>
                </div>

                <Link :href="route('users.edit', user.id)" class="size-full md:size-fit" view-transition>
                    <AppButton name="btn_user_edit">
                        Edit
                    </AppButton>
                </Link>
            </div>
        </div>
        <AppPagination :links="usePage().props.users"/>
    </AdminLayout>
</template>
<script setup lang="js">
    import { Link, usePage } from '@inertiajs/vue3';
    import AdminLayout from '@/layouts/AdminLayout.vue';

    import IndexSearch from '@/pages/users/partials/IndexSearch.vue';

    import AppButton from '@/components/AppButton.vue'
    import AppPagination from '@/components/AppPagination.vue'
</script>