<template>
    <div class="w-full">
        <div class="relative flex items-center">
            <input
                id="search_term"
                name="search_term"
                v-model="searchTerm"
                type="text"
                placeholder="Search for title term"
                @change="onSearch"
                class="w-full py-2 px-4 appearance-none border-4 outline-0 transition duration-300 bg-white border-black text-neutral-700 placeholder:text-neutral-500"
            />
            <div class="absolute top-3 right-3 text-neutral-800">
                <IconSearch v-if="cachedSearchTerm.length < 1" />
                <IconSearchReset class="hover:cursor-pointer" v-if="cachedSearchTerm.length >= 1" @click="resetSearch"/>
            </div>
        </div>
    </div>
</template>
<script setup lang="js">

    import { onMounted, ref, watch } from 'vue';
    import { router, usePage } from '@inertiajs/vue3';
    import IconSearch from '@/icons/IconSearch.vue';
    import IconSearchReset from '@/icons/IconSearchReset.vue';
    
    const searchTerm = ref('');
    const cachedSearchTerm = ref(usePage().props.search.term ?? ''); // must be ref() for watch()

    onMounted(() => searchTerm.value = cachedSearchTerm.value);
    watch(cachedSearchTerm, (new_term, old_term) => searchTerm.value = cachedSearchTerm.value);

    const onSearch = () => {
        router.get(route('users.index', {
            search: searchTerm.value,
        }));
    };
    const resetSearch = () => router.get(route('users.index'));
</script>