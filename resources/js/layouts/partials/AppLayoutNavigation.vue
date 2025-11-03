<template>
    <nav class="flex flex-wrap justify-center gap-8 text-sm font-semibold tracking-wide">
      
        <Link
            v-for="item in usePage().props.categories"
            href="#"
            class="hover:underline uppercase"
        >
            {{ item.title }}
        </Link>
    </nav>
</template>
<script setup lang="js">
    import { Link, usePage } from '@inertiajs/vue3';
</script>