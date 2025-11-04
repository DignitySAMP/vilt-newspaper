<template>
    <button 
        :type="props.type"
        :name="props.name"
        :id="computed_id"
        :disabled="props.disabled"
        class="bg-black text-white px-6 py-2 font-bold hover:bg-gray-800 transition-colors w-full md:w-fit flex gap-2 justify-center cursor-pointer"
        :class="props.reverse ? 'flex-row-reverse' : 'flex-row'"
    >
        <span>
            <slot />
        </span>

        <span v-if="!props.hide_symbol && props.reverse">←</span>
        <span v-else-if="!props.hide_symbol && !props.reverse">→</span>
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
    },
    reverse: {
        type: Boolean,
        default: false
    },
    hide_symbol: {
        type: Boolean,
        default: false
    }
})
const computed_id = computed(() => props.id ?? props.name)
</script>