<template>
    <article class="bg-white border-4 border-black p-6 flex flex-col gap-4">
        <span class="text-lg font-bold tracking-widest">
            Edit Password
        </span>
        <AppInput
            label="Password"
            name="password"
            placeholder="************"
            type="password"
            v-model="form.password"
            :errors="form.errors.password"
            :disabled="form.processing"
            autocomplete="new-password"
        />

        <AppInput
            label="Password Confirmation"
            name="password_confirmation"
            placeholder="************"
            type="password"
            v-model="form.password_confirmation"
            :errors="form.errors.password_confirmation"
            :disabled="form.processing"
            autocomplete="confirm-password"
        />


        <AppButton @click="submit" name="btn_update_password">
            Update Details
        </AppButton>
    </article>
</template>
<script setup lang="js">
    import { useForm } from '@inertiajs/vue3';
    import AppInput from '@/components/AppInput.vue'
    import AppButton from '@/components/AppButton.vue'

    const form = useForm({
        password: '',
        password_confirmation: ''
    });

    const submit = () => {
        form.patch(route('profile.password'), {
            preserveScroll: true,
            onError: (errors) =>  console.error(errors)
        });
    }
</script>