<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Classes - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Classes</h2>
                <!-- <Link :href="route('exercises.create')" v-if="user_role === 'admin'" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                    Create Exercise
                </Link> -->
            </div>
        </template>

        <!-- <div class="flex flex-col space-y-4 p-4 m-20">
            <div 
                v-for="exercise in filteredExercises" 
                :key="exercise.id" 
                class="bg-white shadow-md rounded-lg p-6 w-full mb-5 min-h-[200px] border border-gray-200 hover:bg-gray-100"
            >
                <div class="p-4 mb-4">
                    <Link :href="route('exercises.show', exercise.id)">
                        <h3 class="text-2xl font-bold mb-2 hover:underline">{{ exercise.name }}</h3>
                    </Link>
                </div>
                <div class="text-sm border border-gray-300 rounded-lg p-4 mb-4">
                    <p class="text-black-700 mb-2"><strong>Description<br></strong>{{ exercise.description }}</p>
                </div>
                <div class="text-sm border border-gray-300 rounded-lg p-4 mb-4">
                    <p class="whitespace-pre-line text-black-600">{{ exercise.content }}</p>
                </div>
                <div class="text-sm border border-black-300 rounded-lg p-4 mb-4">
                    <p class="text-black-500"><strong>Created At: </strong>{{ formatDateTime(exercise.created_at) }}</p>
                </div>
                <div class="flex justify-end space-x-4">
                    <button 
                        @click="handleWorkout(exercise.id)" 
                        :class="workoutStatus[exercise.id] ? 'bg-gray-500 cursor-not-allowed' : 'bg-green-500 hover:bg-green-700'" 
                        :disabled="workoutStatus[exercise.id]" 
                        class="text-white px-4 py-2 rounded"
                    >
                        {{ workoutStatus[exercise.id] ? 'Worked out' : 'Work out' }}
                    </button>
                    <button @click="confirmDelete(exercise.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700" v-if="user_role === 'admin'">
                        Delete
                    </button>
                </div>
            </div>
            <div v-if="filteredExercises.length === 0 && !props.noResults" class="text-center text-gray-500">
                No exercises available.
            </div>
            <div v-if="props.noResults" class="text-center text-gray-500">
                No exercises found matching your search.
            </div>
        </div> -->
    </AuthenticatedLayout>
</template>