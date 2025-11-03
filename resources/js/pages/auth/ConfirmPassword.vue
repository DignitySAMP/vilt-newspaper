<template>
      <AppGuestLayout>
        <form @submit.prevent class="flex flex-col gap-2">
            <span class="text-sm">
                In order to access this part of the application, you must confirm your password. 
                Please enter it in the field below and submit in order to procees.
            </span>

            <AppInput
                label="Password Confirmation"
                name="password"
                placeholder="*************"
                type="password"
                v-model="form.password"
                :errors="form.errors.password"
                :disabled="form.processing"
            />

            <AppButton
                name="btn_confirm_password"
                :disabled="form.processing"
                type="submit"
                @click="submit"
            >
                Confirm Password
            </AppButton>
        </form>
    </AppGuestLayout>
</template>
<script setup lang="js">
    import AppGuestLayout from '@/layouts/AppGuestLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import AppButton from '@/components/AppButton.vue';
    import AppInput from '@/components/AppInput.vue';

    const form = useForm({
        password: '',
    })

    const submit = () => {
        form.post(route('password.confirm.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset('password'),
            onError: (error) => console.error(error),
            onFinish: () => form.reset()
        });
    }
</script>