<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Cards from "@/Components/Cards.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
const image = ref("day");
const props = defineProps({
    gameinfo: {
        type: Array,
    }, playersinfo: {
        type: Array,
    }
});
let halfIndex = Math.floor(props.playersinfo.length / 2);
let firstList = props.playersinfo.slice(0, halfIndex);
let secondList = props.playersinfo.slice(halfIndex);
console.log(firstList);
console.log(secondList);
const changephase = () => {
    image.value = image.value == "day" ? "night" : "day";

};
</script>

<template>
    <Head title="New Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Mafia Game #{{ gameinfo[0].id }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-3 gap-2">
                        <div class="grid grid-rows-5 grid-flow-col gap-4">
                            <template v-for="(element, index) in firstList" :key="index">
                                <Cards v-bind:priority="index + 1" v-bind:title="element.name"
                                    v-bind:description="element.name" v-bind:created_at="element.created_at"
                                    v-bind:id="element.id"></Cards>
                            </template>
                        </div>
                        <div class="grid grid-rows-7 grid-flow-col gap-4">
                            <div class="row-span-2">
                                <!-- <img :src="'../storage/images/day_phase.png'" /> -->
                                <img :src="`../storage/images/${image}_phase.png`" />
                            </div>
                            <div class="row-span-4">
                                <div
                                    class="flex flex-col flex-grow w-full max-w-xl bg-white shadow-xl rounded-lg overflow-hidden h-full">
                                    <div class="flex flex-col flex-grow h-0 p-4 overflow-auto">
                                        <!-- message -->
                                        <div class="flex w-full mt-2 space-x-3 max-w-xs">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300"></div>
                                            <div>
                                                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                                                    <p class="text-sm">
                                                        Mafia Has Killed
                                                        <b>Drilon</b>
                                                    </p>
                                                </div>
                                                <span class="text-xs text-gray-500 leading-none">2 min ago</span>
                                            </div>
                                        </div>

                                        <!-- message -->
                                    </div>
                                </div>
                            </div>
                            <div class="row-span-1 mb-2">
                                <button v-on:click="changephase" type="button"
                                    class="h-full w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Default
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-rows-5 grid-flow-col gap-4">
                            <template v-for="(element, index) in secondList" :key="index">
                                <Cards v-bind:priority="index + 1" v-bind:title="element.name"
                                    v-bind:description="element.name" v-bind:created_at="element.created_at"
                                    v-bind:id="element.id"></Cards>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
