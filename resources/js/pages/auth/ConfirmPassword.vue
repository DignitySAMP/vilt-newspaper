<template>
      <AppLayout>
        <div class="flex flex-col gap-2">
            <span class="text-sm">
                In order to access this part of the application, you must confirm your password. 
                Please enter it in the field below and submit in order to procees.
            </span>

            <div class="flex flex-col gap-2">
                <label for="password" class="text-sm text-gray-700">Password Confirmation</label>
                <input type="password" name="password" id="password" v-model="form.password" class="border border-gray-200 shadow px-4 py-1 rounded focus:outline-4 outline-gray-600/50"/>
                <span v-if="form.errors.password" v-html="form.errors.password"  class="text-sm text-red-700"/>
            </div>

            <div class="flex w-full">
                <button :disabled="form.processing" type="submit" @click="submit" class="px-4 py-2 w-full bg-gray-800 text-gray-50 rounded hover:bg-gray-600 transition duration-300 cursor-pointer focus:outline-4 outline-gray-600/50">
                    Confirm Password
                </button>
            </div>
        </div>
    </AppLayout>
</template>
<script setup lang="js">
    import AppLayout from '@/layout/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        password: '',
    })

    const submit = () => {
        form.post(route('password.confirm.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset('password'),
            onError: (error) => console.error(error),
            onFinish: () => form.reset()
        });
    }
</script>