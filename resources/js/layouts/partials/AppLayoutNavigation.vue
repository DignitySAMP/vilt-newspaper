<template>
    <nav class="flex flex-wrap justify-center gap-8 text-sm font-semibold tracking-wide">
      
        <Link
            v-for="item in usePage().props.categories"
            :href="route('home', {
                'category':  item.title.trim() ?? null
            })"
            class="hover:underline uppercase"
        >
            {{ item.title }}
        </Link>

        <div  v-if="usePage().props.auth === null" class="flex gap-8 flex-wrap">
            <Link :href="route('login')" class="text-sm font-semibold text-red-700 tracking-wide uppercase hover:underline">
                Login
            </Link>

            <Link :href="route('register')" class="text-sm font-semibold text-red-700 tracking-wide uppercase hover:underline">
                Register
            </Link>
        </div>

        <div v-else  class="flex gap-8 flex-wrap">
            <Link :href="route('article.index')" class="text-sm font-semibold text-blue-700 tracking-wide uppercase hover:underline">
                Admin
            </Link>
            <Link :href="route('logout')" method="POST" class="text-sm font-semibold text-red-700 tracking-wide uppercase hover:underline">
                Logout
            </Link>

        </div>
    </nav>
</template>
<script setup lang="js">
    import { Link, usePage } from '@inertiajs/vue3';
</script>