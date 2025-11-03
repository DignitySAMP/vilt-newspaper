<template>
    <footer class="border-t-4 border-black bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center flex flex-col gap-4">
            <div class="text-2xl font-black uppercase">
                {{ usePage().props.app.name }}
            </div>
            <div class="text-xs text-gray-600 flex gap-2 justify-center">
                <span>
                    © {{ new Date().getFullYear() }} {{ usePage().props.app.name }}. All rights reserved. 
                </span>
                <span>|</span> 
                <Link href="#" class="hover:underline">Privacy Policy</Link> 
                <span>|</span>
                <Link href="#" class="hover:underline">Terms of Service</Link> 
            </div>
        </div>
    </footer>
</template>
<script setup lang="js">
    import { usePage, Link } from '@inertiajs/vue3';
</script>