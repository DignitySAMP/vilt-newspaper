<template>
    <header class="mt-4 w-full flex justify-center">
        <Link :href="route('home')" view-transition>
            <img src="https://laravel.com/img/notification-logo.png" alt="Laravel Logo" class="size-32" />
        </Link>
    </header>

    <main class="mt-4 container mx-auto max-w-2xl bg-white shadow p-6 rounded">
        <slot/>
    </main>
    <footer class="mt-2 w-full flex justify-center text-sm text-gray-400">
        All rights reserved. Footer goes here.
    </footer>


</template>
<script setup lang="js">
    import { Link } from '@inertiajs/vue3';
</script>