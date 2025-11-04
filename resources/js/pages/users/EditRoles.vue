<template>
    <div class="flex flex-col">
        <span class="text-sm">
            Modify user roles
        </span>
        <div class="border-3 border-black p-2 bg-white flex flex-col gap-2">

            <div 
                v-for="role in props.roles" 
                class="border-2 border-black p-2"
                :class="doesUserHaveRole(role) ? 'bg-green-100' : 'bg-red-100'"    
                @click="onClickRole(role)"
            >
                {{ role.name }}
            </div>

        </div>
        <span class="mt-2 text-sm text-gray-500">
            <span class="font-bold">Hint:</span> click on a role to toggle it on or off.
        </span>
    </div>
    

</template>
<script setup lang="js">
    import { onMounted, ref } from 'vue';

    const model = defineModel();
    const manipulated_roles = ref([]);

    const props = defineProps({
        roles: {
            type: Array,
            required: true
        }
    });

    onMounted(() => manipulated_roles.value = model.value);
    const doesUserHaveRole = (role) => model.value.findIndex(user_role => user_role.id === role.id) !== -1;
    const onClickRole = (role) => {
        const index = manipulated_roles.value.findIndex(user_role => user_role.id === role.id);
        if(index !== -1) manipulated_roles.value.splice(index, 1); 
        else manipulated_roles.value.push(role);
    }
</script>