<template>
    <div class="border-4 border-black bg-red-100 p-4 flex flex-col gap-2">
        <h1 class="text-lg font-black">
            Delete Category
        </h1>

        <span class="text-sm">
            <span class="font-bold">
                Warning:
            </span>
            this is a dangerous area of the application. This action is irreversible. If you wish to continue, confirm the title of the category below:
        </span>

        <AppInput 
            label="Confirm category name"
            name="input_delete" 
            id="input_delete" 
            type="text"
            v-model="form.name" 
            :errors="form.errors.name"
            placeholder="Confirm name"
            :disabled="form.processing"
        />
     
        <AppButton 
            name="btn_delete_category" 
            type="submit" 
            @click="submit"
            :disabled="form.processing"
            :hide_symbol="true"
        >
            Confirm Deletion
        </AppButton>
    </div>
</template>
<script setup lang="js">
    import { useForm } from '@inertiajs/vue3';    
    
    import AppInput from '@/components/AppInput.vue';
    import AppButton from '@/components/AppButton.vue';

    const props = defineProps({
        category: { 
            type: Object,
            required: true
        }
    });

    const form = useForm({
        name: '',
    });

    const submit = () => {
        form.delete(route('category.destroy', props.category), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: (error) => console.error(error),
        });
    }
</script>