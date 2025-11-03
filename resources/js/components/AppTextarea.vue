<template>
    <div class="w-full">
        <label :for="props.name" class="text-sm" :class="props.errors && !props.disabled ? 'text-red-500' : 'text-neutral-700'">
            {{ props.label }}
        </label>
        <textarea
            :id="computed_id"
            :name="props.name"
            v-model="model"
            :placeholder="props.placeholder"
            v-bind="attributes"
            :class="getInputClass"
            :disabled="props.disabled"
        />
        <span v-if="props.errors" class="text-sm text-red-500">{{ props.errors }}</span>
    </div>
</template>
<script setup lang="js">
    import { computed, useAttrs } from 'vue';
    
    const attributes = useAttrs();
    const model = defineModel();

    const props = defineProps({
        label: { 
            type: String, 
            default: '' 
        },
        name: { 
            type: String, 
            required: true 
        },
        placeholder: { 
            type: String, 
            default: '' 
        },
        errors: { 
            type: String, 
            default: '' 
        },
        disabled: { 
            type: Boolean, 
            default: false 
        },
        id: { 
            type: String, 
            required: false 
        }
    });

    const computed_id = computed(() => props.id ?? props.name);
    
    const getInputClass = computed(() => {
        const classes = [];
        
        classes.push("resize-none w-full py-2 px-4 appearance-none border-3 outline-0");
        classes.push(`transition duration-300 ${!props.disabled ? '' : 'cursor-not-allowed'}`); 

        if (props.disabled) {
            classes.push("bg-neutral-300 border-neutral-500 placeholder:text-neutral-600 text-neutral-600"); // disabled
        }
        else {
            if(props.errors) {
                classes.push("bg-white border-red-600 placeholder:text-red-500 text-red-400");   
            }
            else classes.push("bg-white border-black text-neutral-700 placeholder:text-neutral-500"); 
        }
        return classes.join(" ");
    });
</script>

