<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// Define props
const props = defineProps({
    breakfast: {
        type: Array,
        required: true
    }
});

// Function to format the date-time
const formatDateTime = (dateString) => {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric', 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
    };
    return new Date(dateString).toLocaleString(undefined, options);
};
</script>

<template>
    <Head title="Breakfast - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Meal Plans: Breakfast</h2>
            </div>
        </template>

        <div class="flex flex-col space-y-4 p-4 m-20">
            <div 
                v-for="item in breakfast" 
                :key="item.id" 
                class="bg-white shadow-md rounded-lg p-6 w-full mb-5 min-h-[200px] border border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out"
            >
                <div class="p-4 mb-4">
                    <h3 class="text-2xl font-bold mb-2 text-blue-800">{{ item.name }}</h3>
                </div>
                <div class="text-sm border border-gray-300 rounded-lg p-4 mb-4">
                    <p class="text-black-700 mb-2"><strong>Description<br></strong>{{ item.description }}</p>
                </div>
                <div class="text-sm border border-gray-300 rounded-lg p-4 mb-4">
                    <p class="whitespace-pre-line text-black-600">{{ item.content }}</p>
                </div>
                <div class="text-sm border border-black-300 rounded-lg p-4 mb-4">
                    <p class="text-black-500"><strong>Created At: </strong>{{ formatDateTime(item.created_at) }}</p>
                </div>
            </div>
            <div v-if="breakfast.length === 0" class="text-center text-gray-500">
                No breakfast items available.
            </div>
        </div>
    </AuthenticatedLayout>
</template>