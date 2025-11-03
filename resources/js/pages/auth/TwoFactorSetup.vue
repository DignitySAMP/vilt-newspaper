<template>
    <AppGuestLayout>


        <div v-if="usePage().props.mfa_enabled" class="flex flex-col gap-4 text-gray-700">
            <span v-if="confirmed" class="text-sm px-4 py-2 border border-green-300 bg-green-100 text-green-800 rounded">
                You have enabled two factor authentication.
            </span>

            <button

                @click="submitDisable"
                class="flex w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500"
            >
                Disable 2FA
            </button>
        </div>
        <div v-else class="flex flex-col gap-4 text-gray-700">

            <button
                @click="submitEnable"
                class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-600 transition duration-300"
                :disabled="form.processing"
            >
                Enable 2FA
            </button>
         
            <div v-if="qrCode" class="flex flex-col gap-2">
                <span class="text-lg font-semibold">Scan the QR code</span>
                <div v-html="qrCode"></div>

                <div class="flex flex-col gap-2">
                    <input type="text" name="code" id="code" v-model="form.code" placeholder="Code from your authenticator" autocomplete="new-password" class="border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-600"/>
                    <span v-if="form.errors.code" v-html="form.errors.code" class="text-sm text-red-600" ></span>
                </div>

                <button
                    type="button"
                    @click="submitConfirm"
                    :disabled="form.processing"
                    class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50"
                >
                    Confirm 2FA
                </button>

                <span v-if="form.errors.confirmTwoFactorAuthentication" v-html="form.errors.confirmTwoFactorAuthentication.code" class="text-sm text-red-700"/>
            </div>

            <div v-if="recoveryCodes?.length" class="flex flex-col gap-2">
                <div class="flex items-center gap-1">
                    <span class="text-lg font-semibold">Recovery Codes</span>
                    <span class="text-xs">(save these)</span>
                </div>
                
                <pre class="bg-gray-800 text-gray-100 whitespace-pre p-4 rounded"><div v-for="code in recoveryCodes" :key="code">{{ code }}</div></pre>
            </div>
        </div>
    </AppGuestLayout>
</template>

<script setup lang="js">
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import AppGuestLayout from '@/layout/AppGuestLayout.vue';


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

