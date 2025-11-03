<template>
    <AppGuestLayout>
        <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-2">
                <label for="email" class="text-sm text-gray-700">Email address</label>
                <input type="email" name="email" id="email" v-model="form.email" autocomplete="email"  class="border border-gray-200 shadow px-4 py-1 rounded focus:outline-4 outline-gray-600/50"/>
                <span v-if="form.errors.email" v-html="form.errors.email"  class="text-sm text-red-700"/>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="text-sm text-gray-700">Password</label>
                <input type="password" name="password" id="password" v-model="form.password" autocomplete="new-password"  class="border border-gray-200 shadow px-4 py-1 rounded focus:outline-4 outline-gray-600/50"/>
                <span v-if="form.errors.password" v-html="form.errors.password"  class="text-sm text-red-700"/>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password_confirmation" class="text-sm text-gray-700">Password Confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" v-model="form.password_confirmation" class="border border-gray-200 shadow px-4 py-1 rounded focus:outline-4 outline-gray-600/50"/>
                <span v-if="form.errors.password_confirmation" v-html="form.errors.password_confirmation"  class="text-sm text-red-700"/>
            </div>

            <div class="flex w-full">
                <button :disabled="form.processing" type="submit" @click="submit" class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50">
                    Reset Password
                </button>
            </div>
        </div>
    </AppGuestLayout>
</template>
<script setup lang="js">

import AppGuestLayout from '@/layout/AppGuestLayout.vue';
import { useForm } from '@inertiajs/vue3';

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
    form.post(route('login.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('password'),
        onError: (error) => console.error(error),
        onFinish: () => form.reset()
    });
}

</script>