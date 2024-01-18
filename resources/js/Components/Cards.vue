<script setup>
defineProps(["title", "description", "priority", "created_at", "id"]);
</script>

<template>
    <div class="w-full p-3 grid grid-cols-12 gap-1">
        <div
            class="flex flex-col rounded overflow-hidden h-auto lg:h-28 border shadow-lg col-span-12"
        >
            <div
                class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-1 flex flex-col leading-normal"
            >
                <div
                    class="text-black font-bold text-xl mb-2 leading-tight flex justify-between"
                >
                    <p>&nbsp;</p>
                    <p>#{{ priority }}</p>
                </div>
                <p class="mt-2 text-grey-darker  font-bold text-center text-lg">
                    {{ description }}
                </p>
            </div>
        </div>
    </div>
</template>
