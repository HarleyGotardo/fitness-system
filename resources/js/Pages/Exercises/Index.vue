<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref, computed } from 'vue';
import axios from 'axios';

// Define props
let props = defineProps({
    user_id: Number,
    user_role: String,
    exercises_all: Array,
    exercises_assigned_to_you: Array,
    exercise_counters: Array,
    search: String,
    noResults: Boolean,
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

// Function to confirm and delete an exercise
const confirmDelete = (id) => {
    Swal.fire({
        title: 'Are you sure you want to delete this exercise?',
        text: "You won't be able to revert this.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(route('exercises.destroy', { id }))
                .then(response => {
                    Swal.fire('Deleted!', 'The exercise has been deleted.', 'success');
                    // Optionally, you can refresh the page or update the data
                    window.location.reload();
                })
                .catch(error => {
                    Swal.fire('Error!', 'There was an error deleting the exercise.', 'error');
                });
        }
    });
};

// Function to handle "Work out" button click
const handleWorkout = (exercise_id) => {
    axios.get(route('exercises.add_to_counter', { exercise_id, user_id: props.user_id }))
        .then(response => {
            Swal.fire({
                title: 'Success',
                text: 'The exercise has been successfully listed in your exercise counter.',
                icon: 'success',
                confirmButtonText: 'OK'
            });

            // Update the reactive state
            workoutStatus.value[exercise_id] = true;
        })
        .catch(error => {
            Swal.fire({
                title: 'Error',
                text: 'There was an error listing the exercise in your counter.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
};

// Reactive state to track workout status
const workoutStatus = ref({});

// Initialize workout status from props
props.exercises_all.forEach(exercise => {
    workoutStatus.value[exercise.id] = props.exercise_counters.includes(exercise.id);
});
props.exercises_assigned_to_you.forEach(exercise => {
    workoutStatus.value[exercise.id] = props.exercise_counters.includes(exercise.id);
});

// Search state
const searchQuery = ref('');

// Dropdown state
const selectedCategory = ref('all');

// Computed property to get filtered exercises
const filteredExercises = computed(() => {
    let exercises = selectedCategory.value === 'all' ? props.exercises_all : props.exercises_assigned_to_you;
    if (!searchQuery.value) {
        return exercises;
    }
    return exercises.filter(exercise => {
        return exercise.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
               exercise.description.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
               exercise.content.toLowerCase().includes(searchQuery.value.toLowerCase());
    });
});

// Show SweetAlert if no results are found
if (props.noResults) {
    Swal.fire({
        title: 'No Results',
        text: 'No exercises found matching your search.',
        icon: 'info',
        confirmButtonText: 'OK'
    });
}
</script>

<template>
    <Head title="Exercises - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Exercises</h2>
                <div class="relative">
                    <input
                        v-model="searchQuery"
                        placeholder="Search..."
                        class="input shadow-lg focus:border-2 border-gray-300 px-5 py-3 rounded-xl w-56 transition-all focus:w-64 outline-none"
                        name="search"
                        type="search"
                    />
                    <svg
                        class="size-6 absolute top-3 right-3 text-gray-500"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                            stroke-linejoin="round"
                            stroke-linecap="round"
                        ></path>
                    </svg>
                </div>
                <select v-model="selectedCategory" class="input shadow-lg border-gray-300 px-5 py-3 rounded-xl w-56 transition-all outline-none">
                    <option value="all">All Exercises</option>
                    <option value="assigned">Your Exercises</option>
                </select>
                <Link :href="route('exercises.create')" v-if="user_role === 'admin'" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                    Create Exercise
                </Link>
            </div>
        </template>

        <div class="flex flex-col space-y-4 p-4 m-20">
            <div 
                v-for="exercise in filteredExercises" 
                :key="exercise.id" 
                class="bg-white shadow-md rounded-lg p-6 w-full mb-5 min-h-[200px] border border-gray-200 hover:bg-gray-100"
            >
                <div class="p-4 mb-4">
                    <Link :href="route('exercises.show', exercise.id)">
                        <h3 class="text-blue-800 text-2xl font-bold mb-2 hover:underline">{{ exercise.name }}</h3>
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
                        :class="workoutStatus[exercise.id] ? 'bg-gray-500 cursor-not-allowed' : 'bg-orange-500 hover:bg-orange-700'" 
                        :disabled="workoutStatus[exercise.id]" 
                        class="text-white px-4 py-2 rounded"
                    >
                        {{ workoutStatus[exercise.id] ? 'Worked out' : 'Work out' }}
                    </button>
                    <Link :href="(route('exercises.show', {id: exercise.id}))" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                        Details
                    </Link>
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
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Add any additional custom styles here */
</style>