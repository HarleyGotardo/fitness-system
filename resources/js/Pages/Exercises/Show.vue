<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Get the page props
const { props } = usePage();
const exercise = ref(props.exercise);
const exercise_counter = ref(props.exercise_counter);
const exercise_counter_count = ref(props.exercise_counter_count);

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
  <Head title="Exercise Details - Fiber Muscle" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Exercise Details</h2>
      </div>
    </template>

    <div class="flex flex-col space-y-4 p-4 m-20">
      <div class="bg-white shadow-md rounded-lg p-6 w-full mb-5">
        <div class="flex justify-between">
          <div>
            <h3 class="text-lg font-bold">{{ exercise.name }}</h3>
            <p class="text-gray-600">{{ exercise_counter_count }} user(s) have worked out on this exercise.</p>
          </div>
          <div>
            <img src="/images/dumbbell.png" alt="Dumbbell Icon" class="w-10 h-10 mt-2" />
          </div>
        </div>
      </div>

      <!-- Display message if no users have worked out on this exercise -->
      <h2 class="text-2xl font-semibold mb-4 text-center">Users that have worked out on this exercise</h2>
      <div v-if="exercise_counter_count === 0" class="text-center text-gray-600">
        No users have worked out on this exercise.
      </div>

      <!-- Loop through the users who have worked out on this exercise -->
      <div v-else>
        <div v-for="counter in exercise_counter" :key="counter.id" class="bg-white shadow-md rounded-lg p-6 w-full mb-5">
          <div class="flex justify-between">
            <div>
              <h3 class="text-lg font-bold">{{ counter.user.name }}</h3>
              <p class="text-gray-600">Worked out on this exercise on {{ formatDateTime(counter.created_at) }}.</p>
            </div>
            <div>
              <img src="/images/dumbbell-weightlifting.png" alt="Dumbbell Icon" class="w-10 h-10 mt-2" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
/* Add any additional custom styles here */
</style>