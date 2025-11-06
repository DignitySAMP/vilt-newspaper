<template>

<div v-if="showCreateCommentBox">
    <AppTextarea
        label="Post a new comment"
        name="content"
        placeholder="Write your desired comment here..."
        v-model="form.content"
        :errors="form.errors.content"
        :disabled="form.processing"
        rows="6"
    />

    <div class="w-full flex justify-between">
        <AppButton  name="btn_cancel_create_comment" :reverse="true" @click="showCreateCommentBox = false">
            Cancel
        </AppButton>

        <AppButton  name="btn_create_comment" @click="submit">
            Post comment
        </AppButton>
    </div>
</div>
<div class="w-full flex justify-end"  v-if="!showCreateCommentBox">
    <AppButton name="btn_toggle_create_comment" @click="showCreateCommentBox = !showCreateCommentBox">
        Compose new comment
    </AppButton>
</div>
</template>
<script setup lang="js">
    import { ref } from 'vue';
    import { useForm, usePage } from '@inertiajs/vue3';
    
    import AppTextarea from '@/components/AppTextarea.vue'
    import AppButton from '@/components/AppButton.vue'

    const showCreateCommentBox = ref(false);

    const form = useForm({
        article_id: usePage().props.article.id,
        content: ''
    });
    const submit = () => {
        form.post(route('comment.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: (error) => console.error(error)
        });
    }
    
</script>