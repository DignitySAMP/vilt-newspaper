<template>
    <nav class="flex flex-wrap justify-center gap-8 text-sm font-semibold tracking-wide">
      
        <Link
            v-for="item in navigation_items"
            :href="item.route"
            class="hover:underline uppercase"
        >
            {{ item.name }}
        </Link>
    </nav>
</template>
<script setup lang="js">
    import { Link } from '@inertiajs/vue3';
    const navigation_items = [
        {
            route: route('home'),
            name: 'World',
        },
        {
            route: route('home'),
            name: 'Technology',
        },
        {
            route: route('home'),
            name: 'Business',
        },
        {
            route: route('home'),
            name: 'Culture',
        },
        {
            route: route('home'),
            name: 'Opinion',
        }
    ];
</script>