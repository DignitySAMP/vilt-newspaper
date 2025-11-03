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
                autocomplete="password"
                :disabled="form.processing"
            />

            <AppCheckbox
                name="remember"
                label="Remember me"
                v-model="form.remember"
                :disabled="form.processing"
            />

            <div class="flex justify-between text-gray-600 text-sm">
                <Link :href="route('register')" class="hover:underline" view-transition>
                    Don't have an account yet?
                </Link>

                <Link :href="route('password.request')" class="hover:underline" view-transition>
                    Forgot your password?
                </Link>
            </div>


            <AppButton
                :disabled="form.processing"
                type="submit"
                @click="submit"
            >
                Log in
            </AppButton>

        </form>
    </AppGuestLayout>

</template>
<script setup lang="js">

import { useForm, Link } from '@inertiajs/vue3';
import AppGuestLayout from '@/layout/AppGuestLayout.vue';
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';
import AppCheckbox from '@/components/AppCheckbox.vue';

const form = useForm({
    email: '', // OR username: ''
    password: '',
    remember: false
})

const submit = () => {
    form.post(route('login.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('password'),
        onError: (error) => console.error(error),
        onFinish: () => form.reset()
    });
}
</script>