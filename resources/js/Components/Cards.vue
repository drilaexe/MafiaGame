<script setup>
defineProps(["title", "description", "role", "roleid", "id"]);
</script>

<template>
    <div class="w-full h-full p-2 grid grid-cols-12 gap-1">
        <div
            class="flex flex-col rounded overflow-hidden h-auto  border shadow-lg col-span-12"
        >
            <div
                class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-1 flex flex-col leading-normal"
            >
                <div
                    class=" text-black  text-xl mb-2 leading-tight flex justify-between" 
                >
                    <p>&nbsp;</p>
                    <p class=" px-3 bg-indigo-500  font-semibold rounded-md shadow focus:outline-none" v-if="roleid">{{ role }}</p>
                </div>
                <p class="mt-2 text-grey-darker  font-bold text-center text-lg">
                    {{ description }}
                </p>
            </div>
        </div>
    </div>
</template>
