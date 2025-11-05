<template>
    <AdminLayout active_tab="categories">
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
            <AppInput
                label="Description"
                name="description"
                placeholder="Description"
                type="text"
                v-model="form.description"
                :errors="form.errors.description"
                :disabled="form.processing"
            />
            
            <DeleteCategory v-if="showDeleteModal" :category="usePage().props.category" />

            <div class="w-full flex flex-col md:flex-row justify-between gap-4">
                <Link :href="route('category.index')" view-transition>
                    <AppButton name="btn_update_category" type="button" :reverse="true">Back</AppButton>
                </Link>

                <AppButton 
                    name="btn_delete_category" 
                    type="button" 
                    @click="showDeleteModal = !showDeleteModal"
                    :disabled="form.processing"
                    :hide_symbol="true"
                >
                    Delete Category
                </AppButton>
                

                <AppButton name="btn_create_category" type="submit" @click="submit">Update</AppButton>
            </div>
        </form>
        
    </AdminLayout>
</template>
<script setup lang="js">
    import { useForm, usePage, Link } from '@inertiajs/vue3';
    import { ref } from 'vue';

    import AdminLayout from '@/layouts/AdminLayout.vue';

    import AppInput from '@/components/AppInput.vue';
    import AppButton from '@/components/AppButton.vue';
    import DeleteCategory from '@/pages/categories/Delete.vue'

    const showDeleteModal = ref(false);

    const form = useForm({
        title: usePage().props.category.title ?? '',
        description: usePage().props.category.description ?? '',
    });

    const submit = () => {
        form.patch(route('category.update', {
            'category': usePage().props.category.id
        }), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: (error) => console.error(error),
        });
    }
</script>

