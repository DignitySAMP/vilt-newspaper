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

            <DeleteArticle v-if="showDeleteModal" :article="props.article" />

            <div class="w-full flex flex-col md:flex-row justify-between gap-4">
                <Link :href="route('article.index')" view-transition>
                    <AppButton name="btn_update_article" type="button" :reverse="true">Back</AppButton>
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
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AppInput from '@/components/AppInput.vue';
import AppTextarea from '@/components/AppTextarea.vue';
import AppButton from '@/components/AppButton.vue';
import AppSelect from '@/components/AppSelect.vue';
import DeleteArticle from '@/pages/articles/Delete.vue';
import { ref } from 'vue';

const showDeleteModal = ref(false);

const props = defineProps({
    article: {
        type: Object,
        required: true
    }
});

const form = useForm({
    title: props.article.title,
    content: props.article.content,
    summary: props.article.summary,
    image: props.article.image,
    category: props.article.category_id
});


const submit = () => {
    form.patch(route('article.update', props.article.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: (error) => console.error(error),
    });
}
</script>

