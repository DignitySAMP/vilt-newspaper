<template>
    
    <div class="border-3 border-black bg-white p-4 w-full flex flex-col gap-4">
        <div class="w-full flex gap-4 justify-between flex-wrap text-sm text-neutral-600 border-b-2 border-black">
            <span>Posted by {{ props.comment?.author?.name ?? 'Unknown' }}</span>
            <span>{{ new Date(props.comment?.created_at).toDateString() }}</span>
        </div>

      
        <EditComment 
            v-if="editComment" 
            :comment="comment"

            @close-comment="editComment = false"
        />

        <div v-else>
            <pre class="whitespace-break-spaces w-fit"  v-html="props.comment.content"/>

            <div class=" border-t-2 border-black pt-1 w-full flex justify-end items-center" v-if="props.comment?.author?.id === usePage().props.auth?.id">

                <AppButton name="btn_comment_edit" @click="editComment = !editComment">
                    Edit Comment
                </AppButton>
            </div>
        </div>
    </div>
</template>
<script setup lang="js">
    import { ref } from 'vue';
    import {usePage } from '@inertiajs/vue3';

    const editComment = ref(false);
    import EditComment from '@/pages/comments/Edit.vue'

    import AppButton from '@/components/AppButton.vue'

    const props = defineProps({
        comment: {
            type: Object,
            required: true
        }
    });
</script>