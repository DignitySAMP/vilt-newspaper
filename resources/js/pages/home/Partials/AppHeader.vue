<template>
    <header class="border-b-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="text-center border-b-2 border-black pb-4 mb-4">
                <h1 class="text-6xl font-black py-2">
                    {{ usePage().props.app.name }}
                </h1>
                <div class="flex justify-center items-center gap-4 text-xs">
                    <span>{{ currentDate }}</span>
                    <span class="w-1 h-1 bg-black rounded-full" />
                    <span>VOLUME NO. {{ blogPostCount }}</span>
                    <span class="w-1 h-1 bg-black rounded-full" />
                    <span>
                        Established {{ new Date().getFullYear() }}
                    </span>
                </div>
            </div>
            
            <AppNavigation/>
        </div>
    </header>
</template>
<script setup lang="js">
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import AppNavigation from '@/pages/home/Partials//AppNavigation.vue';

    const blogPostCount = 47; // TODO: return count of 'editions'

    const currentDate = computed(() => {
        return new Date().toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    });
</script>