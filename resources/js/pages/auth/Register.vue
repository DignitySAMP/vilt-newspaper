<template>
    <AppGuestLayout>
        <form @submit.prevent class="flex flex-col gap-2">
            <AppInput
                label="Name"
                name="name"
                placeholder="John Doe"
                type="text"
                v-model="form.name"
                :errors="form.errors.name"
                autocomplete="name"
                :disabled="form.processing"
            />

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
                autocomplete="password"
                :disabled="form.processing"
            />

            <AppInput
                label="Password Confirmation"
                name="password_confirmation"
                placeholder="*************"
                type="password"
                v-model="form.password_confirmation"
                :errors="form.errors.password_confirmation"
                autocomplete="new-password"
                :disabled="form.processing"
            />

            <div class="flex justify-end text-gray-600 text-sm">
                <Link :href="route('login')" class="hover:underline" view-transition>
                    Already have an account?
                </Link>
            </div>

            <AppButton
                name="btn_register"
                :disabled="form.processing"
                type="submit"
                @click="submit"
            >
                Register
            </AppButton>
        </form>

    </AppGuestLayout>
</template>
<script setup lang="js">
import AppGuestLayout from '@/layout/AppGuestLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const submit = () => {
    form.post(route('register.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('password'),
        onError: (error) => console.error(error),
        onFinish: () => form.reset()
    });
}

</script>