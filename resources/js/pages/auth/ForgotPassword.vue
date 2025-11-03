<template>
    <AppGuestLayout>
        <form @submit.prevent class="flex flex-col gap-2">
            <span v-if="usePage().props.status" v-html="usePage().props.status" class="text-sm px-4 py-2 border border-green-300 bg-green-100 text-green-800 rounded"/>

            <span class="text-sm text-gray-700">
                If you forgot your password, enter your e-mail below to recieve an e-mail with a reset link.
            </span>

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

            <div class="flex justify-between text-gray-600 text-sm">
                <Link :href="route('login')" class="hover:underline" view-transition>
                    Remember your credentials?
                </Link>

                <Link :href="route('register')" class="hover:underline" view-transition>
                    Don't have an account yet?
                </Link>
            </div>

            <AppButton
                name="btn_request_new_password"
                :disabled="form.processing"
                type="submit"
                @click="submit"
            >
                Request new password
            </AppButton>
        </form>
    </AppGuestLayout>
</template>
<script setup lang="js">
    import AppGuestLayout from '@/layouts/AppGuestLayout.vue';
    import { useForm, usePage, Link } from '@inertiajs/vue3';
    import AppButton from '@/components/AppButton.vue';
    import AppInput from '@/components/AppInput.vue';

    const form = useForm({
        email: '',
    })

    const submit = () => {
        form.post(route('password.email'), {
            preserveScroll: true,
            onSuccess: () => form.reset('password'),
            onError: (error) => console.error(error),
            onFinish: () => form.reset()
        });
    }
</script>