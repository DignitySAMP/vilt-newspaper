<template>
    <AppGuestLayout>
        <div class="flex flex-col gap-2">
            <span v-if="usePage().props.status" v-html="usePage().props.status" class="text-sm px-4 py-2 border border-green-300 bg-green-100 text-green-800 rounded"/>

            <span class="text-sm text-gray-700">
                If you forgot your password, enter your e-mail below to recieve an e-mail with a reset link.
            </span>

            <div class="flex flex-col gap-2">
                <label for="email" class="text-sm text-gray-700">Email address</label>
                <input type="email" name="email" id="email" v-model="form.email" autocomplete="email"  class="border border-gray-200 shadow px-4 py-1 rounded focus:outline-4 outline-gray-600/50"/>
                <span v-if="form.errors.email" v-html="form.errors.email"  class="text-sm text-red-700"/>
            </div>

            <div class="flex justify-between text-gray-600 text-sm">
                <Link :href="route('login')" class="hover:underline" view-transition>
                    Remember your credentials?
                </Link>

                <Link :href="route('register')" class="hover:underline" view-transition>
                    Don't have an account yet?
                </Link>
            </div>

            <div class="flex w-full">
                <button :disabled="form.processing" type="submit" @click="submit" class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50">
                    Request new password 
                </button>
            </div>
        </div>
    </AppGuestLayout>
</template>
<script setup lang="js">
    import AppGuestLayout from '@/layout/AppGuestLayout.vue';
    import { useForm, usePage, Link } from '@inertiajs/vue3';

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