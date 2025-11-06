<template>
    <AppButton 
        name="btn_comment_delete" 
        @click="onDeleteComment" 
        :hide_symbol="true"
    >
        Delete Comment
    </AppButton>
</template>
<script setup lang="js">
    import { useForm } from '@inertiajs/vue3';
    import AppButton from '@/components/AppButton.vue';

    const props = defineProps({
        comment: {
            type: Object,
            required: true
        }
    });

    const onDeleteComment = () => {
        const form = useForm();
        form.delete(route('comment.destroy', props.comment.id), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: (error) => console.error(error)
        });
    }
</script>