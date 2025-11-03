<template>
    <AppGuestLayout>
        <form @submit.prevent class="flex flex-col gap-2">
            <AppInput
                label="E-mail address"
                name="email"
                placeholder="john.doe@email.com"
                type="email"
                v-model="form.email"
                :errors="form.errors.email"
                autocomplete="email"
                :disabled="form.processing"
            />

            <AppInput
                label="Password"
                name="password"
                placeholder="*************"
                type="password"
                v-model="form.password"
                :errors="form.errors.password"
                autocomplete="new-password"
                :disabled="form.processing"
            />

            <AppInput
                label="Password Confirmation"
                name="password_confirmation"
                placeholder="*************"
                type="password"
                v-model="form.password_confirmation"
                :errors="form.errors.password_confirmation"
                :disabled="form.processing"
            />

            <AppButton
                name="btn_reset_password"
                :disabled="form.processing"
                type="submit"
                @click="submit"
            >
                Reset Password
            </AppButton>
        </form>
    </AppGuestLayout>
</template>
<script setup lang="js">

import AppGuestLayout from '@/layouts/AppGuestLayout.vue';
import { useForm } from '@inertiajs/vue3';
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';

const props = defineProps({
    token: {
        type: String,
        required: true
    },
    email: {
        type: String,
        required: true
    },
    
})


const form = useForm({
    email: props.email, 
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.post(route('password.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('password'),
        onError: (error) => console.error(error),
        onFinish: () => form.reset()
    });
}

</script>