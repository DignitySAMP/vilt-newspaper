<template>
    <nav class="flex justify-center text-sm font-semibold tracking-wide">
      
        <div class="hidden md:flex md:flex-row md:gap-8">
            <Link
                v-for="item in navigationList"
                :href="item.url"
                :method="item.method ?? 'GET'"
                class="md:w-fit hover:underline uppercase"
                :class="item.color"
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
                    :class="item.color"
                >
                    <span>{{ item.name }}</span>
                    <span>→</span>
                </Link>
            </div>
        </div>
    </nav>

</template>
<script setup lang="js">
    import { Link, usePage } from '@inertiajs/vue3';
    import { onMounted, ref } from 'vue';

    import IconMobileBreadcrumb from '@/icons/IconMobileBreadcrumb.vue';
    const collapsedNavigation = ref(false);
    const navigationList = ref([]);
  
    onMounted(() => {
        // categories
        usePage().props.categories.forEach(item => {
            navigationList.value.push({
                url: route('home', {
                    'category':  item.title.trim() ?? null
                }),
                name: item.title,
            })
        });

        // unauthenticated
        if(usePage().props.auth === null) {
            navigationList.value.push({
                url: route('login'),
                name: "Login",
                color: "text-red-700",
            },
            {
                url: route('register'),
                name: "Register",
                color: "text-red-700",
            })
        }

        // authenticated
        else if(usePage().props.auth !== null) {
            navigationList.value.push({
                url: route('admin'),
                name: "Admin",
                color: "text-blue-600",
            },
            {
                url: route('logout'),
                name: "Logout",
                method: "POST",
                color: "text-red-600",
            })
        }
    })
</script>