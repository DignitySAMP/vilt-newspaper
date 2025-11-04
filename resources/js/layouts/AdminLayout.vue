<template>
    <header class="border-b-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8">

            <h1 class="text-center border-b-2 border-black pb-4 mb-4 text-3xl font-black py-2">
                Administration Dashboard
            </h1>
            
            <nav class="flex flex-wrap justify-center gap-8 text-sm font-semibold tracking-wide">
                <Link 
                    :href="route('admin')" 
                    class="hover:underline uppercase"
                    :class="props.active_tab === 'home' ? 'font-bold underline' : ''"
                >
                    Dashboard
                </Link>         
                <Link 
                    :href="route('article.index')" 
                    class="hover:underline uppercase"
                    :class="props.active_tab === 'article' ? 'font-bold underline' : ''"
                >
                    Articles
                </Link>
                <Link 
                    :href="route('category.index')" 
                    class="hover:underline uppercase"
                    :class="props.active_tab === 'category' ? 'font-bold underline' : ''"
                >
                    Categories
                </Link>
                <span class="hover:underline uppercase">Users</span>

                <Link :href="route('logout')" method="POST" class="text-sm font-semibold text-red-700 tracking-wide uppercase hover:underline">
                    Logout
                </Link>
            </nav>
        </div>
    </header>

    <AppBody>
        <slot />
    </AppBody>
</template>
<script setup lang="js">
    import AppBody from '@/layouts/Partials/AppLayoutBody.vue';
    import { Link } from '@inertiajs/vue3';
    const props = defineProps({
        active_tab: {
            type: String,
            required: false,
            default: ''
        }
    })
</script>

