<template>
    <header class="border-b-4 border-black bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8 pb-4">

            <h1 class="text-center border-b-2 border-black pb-4 mb-4 text-3xl font-black py-2">
                Administration Dashboard
            </h1>

            <nav>
                
                <div class="hidden md:flex flex-wrap justify-center gap-8 text-sm font-semibold tracking-wide">
                    <Link
                        v-for="item in navigationList"
                        :href="item.url"
                        :method="item.method ?? 'GET'"
                        class="md:w-fit hover:underline uppercase"
                        :class="[
                            item.color,
                            props.active_tab == item.name.toLowerCase() ? 'underline font-bold' : ''    
                        ]"
                    >
                        {{ item.name }}
                    </Link>
                </div>
                <div class="flex flex-col gap-4 md:hidden w-full">
                    <div class="flex w-full justify-between items-center uppercase text-md font-bold" @click="collapsedNavigation = !collapsedNavigation">
                        <IconMobileBreadcrumb class="w-5 h-5" />
                        <span>
                            {{ collapsedNavigation ? 'Hide' : 'Show' }} Navigation
                        </span>
                    </div>

                    <div v-if="collapsedNavigation" class="flex flex-col gap-2 w-full divide-gray-200 divide-y-2">
                        <Link
                                v-for="item in navigationList"
                                :href="item.url"
                                :method="item.method ?? 'GET'"
                                class="md:w-fit hover:underline uppercase flex w-full justify-between"
                                :class="[
                                    item.color,
                                    props.active_tab == item.name.toLowerCase() ? 'underline font-bold' : ''    
                                ]"
                            >
                            <span>{{ item.name }}</span>
                            <span>→</span>
                        </Link>

                    </div>
                </div>

            </nav>
        </div>
    </header>

    <AppBody>
        <slot />
    </AppBody>
</template>
<script setup lang="js">
    import { Link } from '@inertiajs/vue3';
    import { onMounted, ref } from 'vue';

    import AppBody from '@/layouts/Partials/AppLayoutBody.vue';
    import IconMobileBreadcrumb from '@/icons/IconMobileBreadcrumb.vue';

    const props = defineProps({
        active_tab: {
            type: String,
            required: false,
            default: ''
        }
    });

    const collapsedNavigation = ref(false);
    const navigationList = ref([]);
    
    onMounted(() => {
        navigationList.value.push(
            {
                url: route('home'),
                 name: "Home",
                color: "text-blue-500"
            },
            {
                url: route('article.index'),
                 name: "Articles",
            },
            {
                url: route('category.index'),
                 name: "Categories",
            },
            {
                url: route('users.index'),
                 name: "Users",
            },
            {
                url: route('logout'),
                 name: "Logout",
                method: "POST",
                color: "text-red-600",
            },
        )
    });
</script>

