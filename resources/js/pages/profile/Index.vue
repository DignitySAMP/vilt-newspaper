<template>
    <AppLayout>
        <Link :href="route('home')" view-transition>
            <AppButton :reverse="true" name="btn_home">
                Home
            </AppButton>
        </Link>

        <span v-if="usePage().props.flash?.message" class="w-full px-4 py-2 bg-amber-100 border-4 border-amber-300 text-amber-700">
            {{ usePage().props.flash.message }}
        </span>

        <EditDetails/>
        <EditPassword/>
        <EditTwoFactor/>
    </AppLayout>
</template>
<script setup lang="js">
    import { Link, usePage } from '@inertiajs/vue3';
    import AppButton from '@/components/AppButton.vue';

    import AppLayout from '@/layouts/AppLayout.vue';
    
    import EditDetails from '@/pages/profile/partials/EditDetails.vue';
    import EditPassword from '@/pages/profile/partials/EditPassword.vue';
    import EditTwoFactor from '@/pages/profile/partials/EditTwoFactor.vue';
</script>