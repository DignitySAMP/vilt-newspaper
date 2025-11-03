<template>

    <div class="w-full">
        <label :for="props.name" 
            class="text-sm" 
            :class="props.errors && !props.disabled 
                ? 'text-red-500' 
                : 'text-neutral-700'"
            >
            {{ props.label }}
        </label>
        <div class="relative flex items-center">
            <input
                :id="computed_id"
                :name="props.name"
                v-model="model"
                :type="(props.type === 'password' && showPassword) ? 'text' : props.type" 
                :placeholder="props.placeholder"
                v-bind="attributes"
                :class="getInputClass"
                :disabled="props.disabled"
                
            />
            <div 
                class="absolute top-3 right-3"
                :class="props.disabled ? 'text-neutral-500' : props.errors ? 'text-red-500' : 'text-neutral-800'"
            >
                <IconPassword 
                    v-if="props.type === 'password'" 
                    @click="showPassword = !showPassword"
                    :hidden="!showPassword" 
                />

                <IconEmail v-if="props.type === 'email'" />
            </div>
        </div>
        <span v-if="props.errors" class="text-sm text-red-500">
            {{ props.errors }}
        </span>
    </div>
</template>
<script setup lang="js">

    import { computed, ref, useAttrs } from 'vue';
    const attributes = useAttrs()
    
    import IconPassword from '@/icons/IconPassword.vue';
    import IconEmail from '@/icons/IconEmail.vue';

    const showPassword = ref(false);
    const model = defineModel();
    const props = defineProps({
        label: {
            type: String,
            required: false,
            default: '',
        },
        name: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            required: false,
            default: '',
        },
        type: {
            type: String,
            validator: () => ['text', 'email', 'password'],
            required: false,
            default: 'text'
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

    const getInputClass = computed(() => {
        const classes = [];
        
        classes.push("w-full py-2 px-4 appearance-none border-3 outline-0");
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