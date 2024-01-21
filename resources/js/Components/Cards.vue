<script setup>
const props = defineProps(["title", "status", "role", "roleid", "id", "clicked", 'is_bot', 'gamestatus', 'userRole']);
function select(id) {
    if (!props.gamestatus) {
        return
    }
    document.querySelectorAll(".border-sky-500").forEach((element) => {
        // Change the color of each element here
        element.classList.toggle('border-sky-500');
    })
    document.getElementById('card' + id).classList.toggle('border-sky-500');
}
</script>

<template>
    <div class="w-full h-full p-2 grid grid-cols-12 gap-1">
        <div :id="'card' + id" v-on:click="e => (status && is_bot && !roleid) && select(id)"
            v-bind:class="(status) ? '' : 'bg-slate-400'"
            class="flex flex-col rounded overflow-hidden h-auto  border shadow-lg col-span-12 ">
            <div v-bind:class="(status) ? 'bg-white ' : 'bg-slate-400'"
                class="rounded-b lg:rounded-b-none lg:rounded-r p-1 flex flex-col leading-normal">
                <div class=" text-black  text-xl mb-2 leading-tight flex justify-between">
                    <p v-if=status>&nbsp;</p>
                    <p v-else class='px-3 text-white bg-gray-800  font-semibold rounded-md shadow focus:outline-none'>Dead
                    </p>
                    <p class=" px-3 bg-indigo-500  font-semibold rounded-md shadow focus:outline-none" v-if="roleid">{{ role
                    }}</p>
                </div>
                <p class="mt-2 text-grey-darker  font-bold text-center text-lg">
                    {{ title }}
                </p>
            </div>
        </div>
    </div>
</template>
