<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Meal Plans - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Meal Plans</h2>
                <Link :href="route('exercises.create')" v-if="user_role === 'admin'" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                    Create Meal Plan
                </Link>
            </div>
        </template>

        <div class="flex flex-col space-y-4 p-4 m-20">
            <Link :href="route('meal-plans.breakfast')">
                <div class="bg-white shadow-md rounded-lg p-6 w-full mb-5 flex justify-between hover:bg-blue-100">
                    <div>
                        <h3 class="text-lg font-bold">Breakfast</h3>
                        <p class="text-gray-600">Breakfast meal plans located here.</p>
                    </div>
                    <div>
                        <img src="/images/bread-slice-butter.png" alt="Dumbbell Icon" class="w-10 h-10 mt-2" />
                    </div>
                </div>   
            </Link>
            <Link :href="route('meal-plans.lunch')">
                <div class="bg-white shadow-md rounded-lg p-6 w-full mb-5 flex justify-between hover:bg-blue-100">
                    <div>
                        <h3 class="text-lg font-bold">Lunch</h3>
                        <p class="text-gray-600">Lunch meal plans located here.</p>
                    </div>
                    <div>
                        <img src="/images/salad.png" alt="Dumbbell Icon" class="w-10 h-10 mt-2" />
                    </div>
                </div> 
            </Link>    

            <Link :href="route('meal-plans.dinner')">
                <div class="bg-white shadow-md rounded-lg p-6 w-full mb-5 flex justify-between hover:bg-blue-100">
                    <div>
                        <h3 class="text-lg font-bold">Dinner</h3>
                        <p class="text-gray-600">Dinner meal plans located here.</p>
                    </div>
                    <div>
                        <img src="/images/room-service.png" alt="Dumbbell Icon" class="w-10 h-10 mt-2" />
                    </div>
                </div>
            </Link>

            <Link :href="route('meal-plans.snack')">
                <div class="bg-white shadow-md rounded-lg p-6 w-full mb-5 flex justify-between hover:bg-blue-100">
                    <div>
                        <h3 class="text-lg font-bold">Snacks</h3>
                        <p class="text-gray-600">Snack meal plans located here.</p>
                    </div>
                    <div>
                        <img src="/images/milk.png" alt="Dumbbell Icon" class="w-10 h-10 mt-2" />
                    </div>
                </div>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>