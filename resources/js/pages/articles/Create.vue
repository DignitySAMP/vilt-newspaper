<template>
    <AdminLayout>
        <form @submit.prevent class="flex flex-col gap-3">
            <AppInput
                label="Title"
                name="title"
                placeholder="Title"
                type="text"
                v-model="form.title"
                :errors="form.errors.title"
                :disabled="form.processing"
            />
            <AppTextarea
                label="Content"
                name="content"
                placeholder="Write here..."
                v-model="form.content"
                :errors="form.errors.content"
                :disabled="form.processing"
                rows="12"
            />
            <AppTextarea
                label="Summary"
                name="summary"
                placeholder="Short summary"
                v-model="form.summary"
                :errors="form.errors.summary"
                :disabled="form.processing"
                rows="4"
            />
            <AppInput
                label="Image URL"
                name="image"
                placeholder="https://..."
                type="text"
                v-model="form.image"
                :errors="form.errors.image"
                :disabled="form.processing"
            />
            <div class="w-full flex justify-between">
                <Link :href="route('article.index')">
                    <AppButton name="btn_update_article" type="submit" :reverse="true">Back</AppButton>
                </Link>

                <AppButton name="btn_create_article" type="submit">Create</AppButton>
            </div>
        </form>
    </AdminLayout>
</template>
<script setup lang="js">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import AppInput from '@/components/AppInput.vue';
import AppTextarea from '@/components/AppTextarea.vue';
import AppButton from '@/components/AppButton.vue';

const form = useForm({
    title: '',
    content: '',
    summary: '',
    image: ''
});
</script>

