<template>
    <div :class="props.disabled ? 'cursor-not-allowed' : 'cursor-pointer'">
        <label
            :for="props.name"
            class="flex items-center gap-2"
        >
            <div 
                @click="changeModelValue"
                class="w-6 h-6 border-3 border-black" 
                :class="props.disabled ? 'border-neutral-500 bg-neutral-300 text-neutral-500' : 'border-black'"
            >
                <span v-if="model === true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m9 20.42l-6.21-6.21l2.83-2.83L9 14.77l9.88-9.89l2.83 2.83z"/>
                    </svg>
                </span>
            </div>

            <span class="select-none text-sm" :class="!props.disabled  ? 'text-black'  : 'text-neutral-500'" >
                {{ props.label }}
            </span>
        </label>
    </div>
</template>
  
<script setup lang="js">
    const model = defineModel();
    const props = defineProps({
        label: {
            type: String,
            required: false,
            default: '',
        },
        name: {
            type: String,
            required: true,
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false,
        },
    });

    const changeModelValue = () => {
        if(props.disabled) return;
        model.value = !model.value;
    }
</script>
