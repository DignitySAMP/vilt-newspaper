<template>
    <button 
        :type="props.type"
        :name="props.name"
        :id="computed_id"
        :disabled="props.disabled"
        class="bg-black text-white px-6 py-2 font-bold hover:bg-gray-800 transition-colors w-fit flex gap-2 justify-center"
    >
        <span>
            <slot />
        </span>
        <span>
            →
        </span>
    </button>
</template>
<script setup lang="js">
import { computed } from 'vue';
const props = defineProps({
    type: {
        type: String,
        required: false,
        default: 'button',
        validator: () => ['button', 'submit'],
    },
    name: {
        type: String,
        required: true,
    },
    id: {
        type: String,
        required: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    }
})
const computed_id = computed(() => props.id ?? props.name)
</script>