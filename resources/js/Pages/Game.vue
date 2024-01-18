<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Cards from "@/Components/Cards.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="New Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-3 gap-2">
                        <div class="grid grid-rows-5 grid-flow-col gap-4">
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                           
                        </div>
                        <div class="">80%</div>
                        <div class="grid grid-rows-5 grid-flow-col gap-4">
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                            <Cards
                            v-bind:priority="1"
                            v-bind:title="'naem'"
                            v-bind:description="'naem'"
                            v-bind:created_at="'naem'"
                            v-bind:id="'naem'"
                        ></Cards>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
