<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
const props=defineProps({
    gameData: Object,
});
console.log(props.gameData);
function creategame() {
    router.post('/createNewGame', {

        _token: csrfToken,
    })
}
</script>

<template>
    <Head title="New Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                    <button v-on:click="creategame" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm ms-2 mt-2 px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New
                        Game</button>
                    <br />


                    <div class="relative overflow-x-auto">
                        <table className="table-fixed w-full">
                            <thead>
                                <tr className="bg-gray-100">
                                    <th className="px-4 py-2 ">Game No.</th>
                                    <th className="px-4 py-2">Status</th>
                                    <th className="px-4 py-2">Created At</th>
                                    <th className="px-4 py-2">See Game</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="gameData in gameData.data">
                                    <td className="border px-4 py-2">Game #{{ gameData.id }}</td>
                                    <td className="border px-4 py-2" >{{ gameData.status==1?'Active':'Ended' }}</td>
                                    <td className="border px-4 py-2">{{ gameData.created_at }}</td>
                                    <td className="border px-4 py-2"><a :href="'/game/' + gameData.id">Go To The Game ></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination class="mt-6" :links="gameData.links" />
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
