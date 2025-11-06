<template>
    <AppGuestLayout>
        <div class="flex flex-col gap-2 text-gray-700">
            <span class="text-lg font-semibold">Two factor authentication</span>

            <p class="text-gray-600 text-sm">
                Please confirm access to your account by entering the authentication code provided by your app.
            </p>

            <form @submit.prevent v-if="!recoveryMode" class="flex flex-col gap-2">
         
                <AppInput
                    label="Authentication Code"
                    name="code"
                    placeholder="Code from your authenticator"
                    type="text"
                    v-model="form.code"
                    :errors="form.errors.code"
                    :disabled="form.processing"
                />

                <AppButton @click="submitCode" name="btn_login" :disabled="form.processing">
                    Log In
                </AppButton>
                

                <p class="text-sm text-gray-600 cursor-pointer hover:underline" @click="recoveryMode = true">
                    Use a recovery code instead
                </p>
            </form>

            <form @submit.prevent v-else class="flex flex-col gap-2">                         
                <AppInput
                    label="Recovery Code"
                    name="recovery_code"
                    placeholder="Recovery Code"
                    type="text"
                    v-model="form.recovery_code"
                    :errors="form.errors.recovery_code"
                    :disabled="form.processing"
                />

                <AppButton @click="submitRecoveryCode" name="btn_login" :disabled="form.processing">
                    Log In
                </AppButton>

                <p class="text-sm text-gray-600 cursor-pointer hover:underline" @click="recoveryMode = false">
                    Use an authentication code instead
                </p>
            </form>
        </div>
    </AppGuestLayout>
</template>

<script setup>
import AppGuestLayout from '@/layouts/AppGuestLayout.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'

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
