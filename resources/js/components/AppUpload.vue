<template>
    <div class="w-full">
        <label :for="computed_id" class="text-sm" :class="props.errors && !props.disabled ? 'text-red-500' : 'text-neutral-700'">
            {{ props.label }}
        </label>
        
        <div class="flex flex-col gap-2">
            <input 
                v-if="!selectedFile"
                type="file"
                :id="computed_id"
                :name="props.name"
                :placeholder="props.placeholder"
                v-bind="attributes"
                ref="fileInput"
                @change="handleFileSelect"
                :disabled="props.disabled"
                :accept="props.accept"
                :class="getInputClass"
            />
            

            <div v-if="selectedFile">
                <div class="grid grid-cols-[1fr_auto] items-center w-full h-full gap-2">
                    <span class="text-neutral-700 truncate border-4 border-black w-full bg-white  px-4 py-2 select-none">
                        {{ selectedFile.name }} ({{ formatBytes(selectedFile.size) }})
                    </span>

                    <AppButton name="btn_remove_file" @click="removeFile">
                        Remove File
                    </AppButton>
                </div>
            </div>
        </div>
        
        <span v-if="props.errors" class="text-sm text-red-500">{{ props.errors }}</span>
    </div>
</template>

<script setup lang="js">
import { computed, useAttrs, ref } from 'vue';
import AppButton from '@/components/AppButton.vue'

const attributes = useAttrs();
const model = defineModel();
const fileInput = ref(null);
const selectedFile = ref(null);

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
    },
    accept: {
        type: String,
        default: ''
    }
});

const computed_id = computed(() => props.id ?? props.name);

const getInputClass = computed(() => {
    const classes = [];
    
    classes.push("resize-none w-full py-2 px-4 appearance-none border-3 outline-0");
    classes.push(`transition duration-300 ${!props.disabled ? '' : 'cursor-not-allowed'}`); 

    if (props.disabled) {
        classes.push("bg-neutral-300 border-neutral-500 placeholder:text-neutral-600 text-neutral-600");
    }
    else {
        if(props.errors) {
            classes.push("bg-white border-red-600 placeholder:text-red-500 text-red-400");   
        }
        else classes.push("bg-white border-black text-neutral-700 placeholder:text-neutral-500"); 
    }
    return classes.join(" ");
});

const handleFileSelect = (event) => {
    const file = event.target.files?.[0] || null;
    selectedFile.value = file;
    model.value = file;
};

const removeFile = () => {
    selectedFile.value = null;
    model.value = null;
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

const formatBytes = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
};
</script>