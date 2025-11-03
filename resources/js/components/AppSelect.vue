<template>
    <div class="flex flex-col">
        <label :for="props.name" 
            class="text-sm" 
            :class="props.errors && !props.disabled 
                ? 'text-red-500' 
                : 'text-neutral-700'"
            >
            {{ props.label }}
        </label>
        <select 
            :name="props.name" 
            :id="computed_id" 
            v-model="model" 
            class="outline-0 px-4 py-2 border-4 bg-white border-black"
        >
            <option 
                v-for="option in props.options" 
                :value="option.id"
            >
                {{ option.name }}
            </option>
        </select>
    </div>
</template>
<script setup lang="js">
    import { computed, onMounted } from 'vue';

    const model = defineModel();
    const props = defineProps({
        name: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: false,
        },
        options: {
            type: Array,
            required: true
        },
        errors: {
            type: String,
            required: true
        },
        errors: {
            type: String,
            required: false,
            default: '',
        },
        disabled: {
            type: Boolean,
            required: false,
        }
    });

    const computed_id = computed(() => props.id ?? props.name);

    onMounted(() => {
        if(model.value === null) {
            model.value = 1;
        }
    })
</script>