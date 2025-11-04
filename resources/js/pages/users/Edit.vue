<template>
    <AdminLayout active_tab="article">
        <form @submit.prevent class="flex flex-col gap-3">
            <AppInput
                label="Name"
                name="name"
                placeholder="John Doe"
                type="text"
                v-model="form.name"
                :errors="form.errors.name"
                :disabled="form.processing"
                autocomplete="username"
            />

            <AppInput
                label="E-mail address"
                name="email"
                placeholder="john.doe@email.com"
                type="email"
                v-model="form.email"
                :errors="form.errors.email"
                :disabled="form.processing"
                autocomplete="email"
            />

            <AppInput
                label="Password"
                name="password"
                type="password"
                v-model="form.password"
                :errors="form.errors.password"
                :disabled="form.processing"
                autocomplete="new-password"
            />

            <AppInput
                label="Password (confirm)"
                name="password_confirmation"
                type="password"
                v-model="form.password_confirmation"
                :errors="form.errors.password_confirmation"
                :disabled="form.processing_confirmation"
                autocomplete="password-confirm"
            />

            <EditRoles 
                :roles="usePage().props.roles" 
                v-model="form.roles" 
                :user_roles="form.roles"
            />

            <div class="w-full flex flex-col md:flex-row justify-between gap-4">
                <Link :href="route('users.index')" view-transition>
                    <AppButton name="btn_update_user" type="button" :reverse="true">Back</AppButton>
                </Link>

                <AppButton 
                    name="btn_delete_user" 
                    type="button" 
                    :disabled="form.processing"
                    :hide_symbol="true"
                >
                    Delete User
                </AppButton>
                

                <AppButton name="btn_update_user" type="submit" @click="submit">Save</AppButton>
            </div>
        </form>
    </AdminLayout>
</template>
<script setup lang="js">

    import { useForm, usePage, Link } from '@inertiajs/vue3';

    import AdminLayout from '@/layouts/AdminLayout.vue';
    import AppInput from '@/components/AppInput.vue';
    import AppButton from '@/components/AppButton.vue';
    import EditRoles from '@/pages/users/EditRoles.vue';

    const form = useForm({
        name: usePage().props.user.name,
        email: usePage().props.user.email,
        roles: usePage().props.user.roles,
        password: '',
        password_confirmation: ''
    });
 
    const submit = () => {
        form.patch(route('users.update', usePage().props.user.id), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: (error) => console.error(error),
        });
    }
</script>