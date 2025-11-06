<template>
    <article class="bg-white border-4 border-black p-6 flex flex-col gap-4">
        <span class="text-lg font-bold tracking-widest">
            Two Factor Authentication
        </span>

        <div v-if="usePage().props.mfa_enabled" class="flex flex-col gap-4 text-gray-700">
            <span v-if="confirmed" class="w-full px-4 py-2 bg-amber-100 border-4 border-amber-300 text-amber-700">
                You have enabled two factor authentication.
            </span>

            <AppButton
                name="btn_disable_2fa"
                @click="submitDisable"
                type="button"
            >
                Disable 2FA
            </AppButton>
        </div>
        <div v-else class="flex flex-col gap-4 text-gray-700">

            <AppButton
                name="btn_enable_2fa"
                @click="submitEnable"
                type="button"
                :disabled="form.processing"
            >
                Enable 2FA
            </AppButton>
            
            <div v-if="qrCode" class="flex flex-col gap-2">
                <span class="text-lg font-semibold">1. Scan the QR code:</span>
                <div v-html="qrCode"></div>

                <span class="text-lg font-semibold">2. Enter the code from your authenticator:</span>
                <AppInput
                    name="code"
                    placeholder="Code from your authenticator"
                    type="text"
                    v-model="form.code"
                    :errors="form.errors.code"
                    autocomplete="new-password"
                    :disabled="form.processing"
                />
                <span class="text-lg font-semibold">3. Confirm the code:</span>
                <AppButton
                    name="btn_confirm_2fa"
                    type="button"
                    @click="submitConfirm"
                    :disabled="form.processing"
                >
                    Activate 2FA
                </AppButton>

                <span v-if="form.errors.confirmTwoFactorAuthentication" v-html="form.errors.confirmTwoFactorAuthentication.code" class="text-sm text-red-700"/>
            </div>

            <div v-if="recoveryCodes?.length" class="flex flex-col gap-2">

                <span class="text-lg font-semibold">4. Save your recovery codes:</span>
                <pre class="bg-neutral-800 text-gray-100 whitespace-pre p-4 rounded"><div v-for="code in recoveryCodes" :key="code">{{ code }}</div></pre>
            </div>
        </div>
    </article>
</template>

<script setup lang="js">
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import AppButton from '@/components/AppButton.vue';
import AppInput from '@/components/AppInput.vue';


const form = useForm({
    code: '',
});

const qrCode = ref(null);
const recoveryCodes = ref([]);

const submitEnable = () => {
    form.post(route('two-factor.enable'), {
        preserveScroll: true,
        onSuccess: async () => {
            await fetch2FAQRCode();
            await fetch2FARecoveryCodes();
        },
        onError: (error) => console.error(error),
        onFinish: () => form.reset(),
    });
};

const confirmed = ref(false);
const submitConfirm = () => {
    form.post(route('two-factor.confirm'), {
        preserveScroll: true,
        onSuccess: async () => {
            
            confirmed.value = true;
            await fetch2FARecoveryCodes(); // refresh codes after confirmation
        },
        onError: (error) => console.error(error),
        onFinish: () => form.reset(),
    });
};

const fetch2FAQRCode = async () => {
    try {
        const response = await axios.get(route('two-factor.qr-code'));
        qrCode.value = response.data.svg;
    } catch (error) {
        console.error(error);
    }
};

const fetch2FARecoveryCodes = async () => {
    try {
        const response = await axios.get(route('two-factor.recovery-codes'));
        recoveryCodes.value = response.data;
    } catch (error) {
        console.error(error);
    }
};

const submitDisable = () => {
    form.delete(route('two-factor.disable'), {
        preserveScroll: true,
        onSuccess: () => {
            qrCode.value = null;
            recoveryCodes.value = [];
        },
    });
};

</script>

