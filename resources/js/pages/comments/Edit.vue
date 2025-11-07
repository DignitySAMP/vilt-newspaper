<template>
    <form @submit.prevent>
        <AppTextarea
            name="content"
            placeholder="Write here..."
            v-model="form.content"
            :errors="form.errors.content"
            rows="10"
        />

        <div class="w-full flex justify-between">

            <AppButton 
                name="btn_comment_save" 
                @click="emit('close-comment')" 
                :reverse="true"
            >
                Go back
            </AppButton>

            <DeleteComment 
                :comment="props.comment"
            />

            <AppButton 
                name="btn_comment_save" 
                @click="onEditComment()"
            >
                Save Comment
            </AppButton>


        </div>
    </form>
</template>
<script setup lang="js">
    import { useForm } from '@inertiajs/vue3';

    import DeleteComment from '@/pages/comments/Delete.vue'
    import AppTextarea from '@/components/AppTextarea.vue'
    import AppButton from '@/components/AppButton.vue'
    
    const emit = defineEmits(['close-comment']);

    const props = defineProps({
        comment: {
            type: Object,
            required: true
        }
    });

    const form = useForm({content: props.comment.content })
    const onEditComment = () => {

        form.patch(route('comment.update', props.comment.id), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                emit('close-comment');
            },
            onError: (error) => console.error(error)
        });
    }    
</script>
