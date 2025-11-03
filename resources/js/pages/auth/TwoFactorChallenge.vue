<template>
    <AppGuestLayout>
        <div class="flex flex-col gap-2 text-gray-700">
            <span class="text-lg font-semibold">Two factor authentication</span>

            <p class="text-gray-600 text-sm">
                Please confirm access to your account by entering the authentication code provided by your app.
            </p>

            <form @submit.prevent="submitCode" v-if="!recoveryMode" class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label for="code" class="block text-gray-700 text-sm">Authentication Code</label>
                    <input type="text" name="code" id="code" v-model="form.code" placeholder="Code from your authenticator" autocomplete="new-password" class="border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-600"/>
                    <span v-if="form.errors.code" v-html="form.errors.code" class="text-sm text-red-600" ></span>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50"
                >
                    Log In
                </button>

                <p class="text-sm text-gray-600 cursor-pointer hover:underline" @click="recoveryMode = true">
                    Use a recovery code instead
                </p>
            </form>

            <form @submit.prevent="submitRecoveryCode" v-else  class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label for="recovery_code" class="block text-gray-700 text-sm">Recovery Code</label>
                    <input id="recovery_code" type="text" v-model="form.recovery_code" placeholder="Recovery code" autofocus class="border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-600"/>
                    <span v-if="form.errors.recovery_code" v-html="form.errors.recovery_code" class="text-sm text-red-600" ></span>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50"
                >
                    Log In
                </button>

                <p class="text-sm text-gray-600 cursor-pointer hover:underline" @click="recoveryMode = false">
                    Use an authentication code instead
                </p>
            </form>
        </div>
    </AppGuestLayout>
</template>

<script setup>
import AppGuestLayout from '@/layout/AppGuestLayout.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const recoveryMode = ref(false)

const form = useForm({
    code: '',
    recovery_code: '',
})

// Submit authenticator app code
const submitCode = () => {
    form.post(route('two-factor.login'), {
        onFinish: () => form.reset('code'),
    })
}

// Submit recovery code
const submitRecoveryCode = () => {
    form.post(route('two-factor.login'), {
        onFinish: () => form.reset('recovery_code'),
    })
}
</script>
