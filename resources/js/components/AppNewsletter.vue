<template>

    <div  v-if="usePage().props.newsletter !== null" class="p-6 border-4 border-black bg-white flex flex-col gap-2">

        <span class="text-lg font-bold">
            Newsletter
        </span>
        <span v-if="usePage().props.flash.newsletter" class="p-3 border-3 border-amber-600 bg-amber-50 text-amber-900">
            {{ usePage().props.flash.newsletter }}
        </span>
        

        <span v-if="form.errors.email" class="p-3 border-3 border-red-600 bg-red-100 text-red-700">
            {{ form.errors.email }}
        </span>
        
        <div class="flex justify-between flex-wrap gap-4" v-if="subscriptionState">          
            You are subscribed to our newsletter. Want to tune out from updates?

            <AppButton name="btn_newsletter_unsubscribe" @click="unsubscribe">
                Unsubscribe
            </AppButton>
        </div>
        <span class="flex justify-between flex-wrap gap-4"  v-else>
            <div class="flex gap-1">
                You are <span class="font-bold">not subscribed</span> to our newsletter. Want to stay up to date with our latest articles?
            </div>

            <AppButton name="btn_newsletter_subscribe" @click="subscribe">
                Subscribe
            </AppButton>
        </span>

    </div>

</template>
<script setup lang="js">
    import { ref } from 'vue';
    import { usePage, useForm } from '@inertiajs/vue3';
    import AppButton from '@/components/AppButton.vue'

    const subscriptionState = ref(usePage().props.newsletter ? true : false);
    const form = useForm({
        email: usePage().props.auth?.email ?? null
    });

    const subscribe = () => {
        if(form.email !== null) {
            form.post(route('newsletter.subscribe'), {

                preserveScroll: true,
                onSuccess: () => subscriptionState.value = true,
                onError: (errors) => console.error(errors)
            })
        }
    }

    const unsubscribe = () => {

        form.delete(route('newsletter.unsubscribe'), {

            preserveScroll: true,
            onSuccess: () => subscriptionState.value = false,
            onError: (errors) => console.error(errors)
        })
    }

</script>