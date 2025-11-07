<template>
    <AdminLayout active_tab="articles">
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

            <AppUpload
                label="Upload a file you wish to use"
                name="image"
                v-model="form.image"
                :errors="form.errors.image"
                :disabled="form.processing"
            />

            <AppSelect
                label="Choose article category"
                name="select_category"
                v-model="form.category"
                :errors="form.errors.category"
                :options="usePage().props.categories.map(cat => ({
                    id: cat.id,
                    name: cat.title,
                }))"
            />

            <DeleteArticle v-if="showDeleteModal" :article="usePage().props.article" />

            <div class="w-full flex flex-col md:flex-row justify-between gap-4">
                <Link :href="route('article.index')" view-transition>
                    <AppButton name="btn_return_article" type="button" :reverse="true">Back</AppButton>
                </Link>

                <AppButton 
                    name="btn_delete_article" 
                    type="button" 
                    @click="showDeleteModal = !showDeleteModal"
                    :disabled="form.processing"
                    :hide_symbol="true"
                >
                    Delete Article
                </AppButton>
                

                <AppButton name="btn_update_article" type="submit" @click="submit">Save</AppButton>
            </div>
        </form>
    </AdminLayout>
</template>
<script setup lang="js">

import { ref } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';

import AdminLayout from '@/layouts/AdminLayout.vue';
import DeleteArticle from '@/pages/articles/Delete.vue';

import AppInput from '@/components/AppInput.vue';
import AppTextarea from '@/components/AppTextarea.vue';
import AppButton from '@/components/AppButton.vue';
import AppSelect from '@/components/AppSelect.vue';
import AppUpload from '@/components/AppUpload.vue';

const showDeleteModal = ref(false);

const form = useForm({
    _method: 'patch',
    title: usePage().props.article.title,
    content: usePage().props.article.content,
    summary: usePage().props.article.summary,
    image: null,
    category: usePage().props.article.category_id
});


const submit = () => {
    form.post(route('article.update', usePage().props.article.id), { // we spoof this as a post, while it remains a patch
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => form.reset(),
        onError: (error) => console.error(error),
    });
}
</script>

