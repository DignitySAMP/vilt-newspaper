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
            
            <div class="w-full flex flex-col md:flex-row justify-between gap-4">
                <Link :href="route('category.index')" view-transition>
                    <AppButton name="btn_update_category" type="button" :reverse="true">Back</AppButton>
                </Link>

                <AppButton name="btn_create_category" type="submit" @click="submit">Create</AppButton>
            </div>
        </form>
    </AdminLayout>
</template>
<script setup lang="js">
    import { useForm, usePage, Link } from '@inertiajs/vue3';

    import AdminLayout from '@/layouts/AdminLayout.vue';

    import AppInput from '@/components/AppInput.vue';
    import AppButton from '@/components/AppButton.vue';

    const form = useForm({
        title: '',
        description: '',
    });

    const submit = () => {
        form.post(route('category.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: (error) => console.error(error),
        });
    }
</script>

