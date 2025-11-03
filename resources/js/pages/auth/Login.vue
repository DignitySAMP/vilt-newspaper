<template>
        <form @submit.prevent class="flex flex-col gap-2">
            <div class="flex flex-col gap-2">
                <label class="text-sm text-gray-700" for="email">Email address</label>
                <input type="email" name="email" id="email" v-model="form.email" autocomplete="email" class="border border-gray-200 shadow px-4 py-1 rounded focus:outline-4 outline-gray-600/50"/>
                <span v-if="form.errors.email" v-html="form.errors.email" class="text-sm text-red-700"/>
            </div>


            <div class="flex flex-col gap-2">
                <label class="text-sm text-gray-700" for="password">Password</label>
                <input type="password" name="password" id="password" v-model="form.password" autocomplete="password" class="border border-gray-200 shadow px-4 py-1 rounded focus:outline-4 outline-gray-600/50"/>
                <span v-if="form.errors.password" v-html="form.errors.password" class="text-sm text-red-700"/>
            </div>

    <AppGuestLayout>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" v-model="form.remember" autocomplete="remember" class="size-4 checked:accent-gray-500"/>
                <label class="text-sm text-gray-700" for="remember">Remember me?</label>
            </div>

            <div class="flex justify-between text-gray-600 text-sm">

                <Link :href="route('register')" class="hover:underline" view-transition>
                    Don't have an account yet?
                </Link>

                <Link :href="route('password.request')" class="hover:underline" view-transition>
                    Forgot your password?
                </Link>
            </div>

            <div class="flex w-full">
                <button :disabled="form.processing" type="submit" @click="submit" class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50">
                    Log in
                </button>
            </div>
        </form>
    </AppGuestLayout>

</template>
<script setup lang="js">

import { useForm, Link } from '@inertiajs/vue3';
import AppGuestLayout from '@/layout/AppGuestLayout.vue';

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