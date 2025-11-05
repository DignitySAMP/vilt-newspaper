<template>
    <header class="border-b-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8 pb-4">
            <div class="text-center border-b-2 border-black pb-4 mb-4">
                <h1 class="text-6xl font-black py-2">
                    {{ usePage().props.app.name }}
                </h1>
                <div class="hidden md:flex justify-center items-center gap-4 text-xs">
                    <span>{{ currentDate }}</span>
                    <AppSeparator/>
                    <span>VOLUME NO. {{ blogPostCount }}</span>
                    <AppSeparator/>
                    <span>
                        Established {{ new Date().getFullYear() }}
                    </span>
                </div>
            </div>
            
            <AppLayoutNavigation/>
        </div>
    </header>
</template>
<script setup lang="js">
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import AppLayoutNavigation from '@/layouts/partials/AppLayoutNavigation.vue';
    import AppSeparator from '@/components/AppSeparator.vue';

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