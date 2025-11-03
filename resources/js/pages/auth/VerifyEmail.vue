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

            <div class="flex w-full">
                <button :disabled="form.processing" type="button" @click="form.post(route('verification.send'))" class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50">
                    Request new link
                </button>
            </div>


            <div class="flex justify-end text-gray-600 text-sm">
                <span click="form.post(route('logout'))" class="hover:underline">
                    Log out
                </span>
            </div>
        </div>
    </AppGuestLayout>

</template>
<script setup lang="js">
import AppGuestLayout from '@/layout/AppGuestLayout.vue'
import { useForm, usePage } from '@inertiajs/vue3';
const form = useForm();
</script>