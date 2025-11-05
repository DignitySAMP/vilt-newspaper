<template>

    <div class="w-full">
        <div class="relative flex items-center">
            <input
                id="search_term"
                name="search_term.name"
                v-model="model"
                type="text"
                placeholder="Enter a search term"
                
                class="w-full py-2 px-4 appearance-none border-4 outline-0 transition duration-300 bg-white border-black text-neutral-700 placeholder:text-neutral-500"
            />
            <div class="absolute top-3 right-3 text-neutral-800">
                <IconSearch />
            </div>
        </div>
    </div>
</template>
<script setup lang="js">

    import { ref } from 'vue';
    
    import IconSearch from '@/icons/IconSearch.vue';
    const model = defineModel();
   


</script>