<template>
    <AppGuestLayout>
        <div class="flex flex-col gap-2">
            <div v-if="usePage().props.status !== null && usePage().props.status === 'verification-link-sent'" class="text-sm text-center px-4 py-2 border border-green-300 bg-green-100 text-green-800 rounded">
                A new verification link has been sent to the email address you provided during registration.
            </div>

            <span class="text-sm">
                In order to access this part of the application, you must verify your e-mail address. You should have recieved an e-mail during your registration. 
            </span>
            <span class="text-sm">
                If you lost the e-mail, you may click the button below to request a new verification e-mail.
            </span>

            <AppButton
                name="btn_resend-verification-link"
                :disabled="form.processing"
                type="button"
                @click="form.post(route('verification.send'))"
            >
                Request new link
            </AppButton>

            <div class="flex justify-end text-gray-600 text-sm">
                <span @click="form.post(route('logout'))" class="hover:underline cursor-pointer">
                    Log out
                </span>
            </div>
        </div>
    </AppGuestLayout>

</template>
<script setup lang="js">
import { useForm, usePage } from '@inertiajs/vue3';
import AppGuestLayout from '@/layouts/AppGuestLayout.vue'

import AppButton from '@/components/AppButton.vue';
const form = useForm();
</script>