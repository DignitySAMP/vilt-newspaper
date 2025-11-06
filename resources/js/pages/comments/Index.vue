<template>

<div class="flex flex-col gap-2 w-full">
    
        <span class="text-2xl font-bold tracking-widest">
            Comments
        </span>
        <span v-if="usePage().props.flash?.message" class="w-full px-4 py-2 bg-amber-100 border-4 border-amber-300 text-amber-700">
            {{ usePage().props.flash.message }}
        </span>

        <CreateComment/>

        <div class="flex flex-col gap-2">
            <ShowComment v-for="comment in props.comments.data" :comment="comment" :key="comment.id"/>
        </div>

        <AppPagination :links="props.comments"/>
    </div>
</template>
<script setup lang="js">
    import { usePage } from '@inertiajs/vue3';
    import AppPagination from '@/components/AppPagination.vue'
    import CreateComment from '@/pages/comments/Create.vue'
    import ShowComment from '@/pages/comments/Show.vue'

    const props = defineProps({
        comments: {
            type: Object,
            required: true
        }
    });

</script>