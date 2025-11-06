<template>
    <article class="bg-white border-4 border-black p-6 flex flex-col gap-4">
        <span class="text-lg font-bold tracking-widest">
            Edit Profile Details
        </span>
        <AppInput
            label="Name"
            name="name"
            placeholder="John Doe"
            type="text"
            v-model="form.name"
            :errors="form.errors.name"
            :disabled="form.processing"
        />

        <AppInput
            label="E-mail address"
            name="email"
            placeholder="john.doe@example.com"
            type="email"
            v-model="form.email"
            :errors="form.errors.email"
            :disabled="form.processing"
        />

        <AppButton @click="submit" name="btn_update_details">
            Update Details
        </AppButton>

    </article>
</template>
<script setup lang="js">
    import { useForm, usePage } from '@inertiajs/vue3';
    import AppInput from '@/components/AppInput.vue'
    import AppButton from '@/components/AppButton.vue'

    const form = useForm({
        name:  usePage().props.auth.name,
        email:  usePage().props.auth.email,
    });

    const submit = () => {
        form.patch(route('profile.details'), {
            preserveScroll: true,
            onError: (errors) =>  console.error(errors)
        });
    }
    
</script>