<template>

    <div class="flex py-2 justify-center items-center">
        <div class="select-none flex flex-wrap items-center justify-center gap-2 text-white">
            <template
                v-model="props.links"
                v-for="(link, index) in links.links"
                :key="index"
            >
                <div
                    v-if="link.url === null"
                    class="uppercase bg-black text-white px-4 py-2 font-bold transition duration-300 opacity-40 cursor-not-allowed"
                >
                    <span v-html="link.label"></span>
                </div>
                
                <div v-else class="flex">
                    <Link as="button"
                        class="uppercase font-bold transition duration-300"
                        :class="[
                            link.label.includes('Next') || link.label.includes('Previous') ? 'bg-black hover:bg-neutral-700  text-white w-fit px-4 h-10 cursor-pointer' : link.active == true ? 
                                'bg-black text-white size-10' : 
                                'bg-white text-black border-2 border-black hover:bg-neutral-200 size-10  cursor-pointer',
                            ]
                        "
                        :href="link.url"
                        v-html="link.label"
                    />
                </div>
            </template>
        </div>
    </div>
</template>

<script setup lang="js">
	import { Link } from '@inertiajs/vue3';
    
	// Important: the prop here must be the full laravel pagination object, not just the links
	const props = defineProps({
		links: {
			type: Object,
			required: true,
		},
	});
</script>