<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Admin - Fiber Muscle" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin
      </h2>
    </template>

    <div class="flex flex-col space-y-4 p-4 m-20">
        <Link :href="route('exercises.index')">
            <div class="bg-white shadow-md rounded-lg p-6 w-full mb-5">
                <div class="flex justify-between">
                    <div>
                        <h3 class="text-lg font-bold">Add Exercises</h3>
                        <p class="text-gray-600">Add exercise plans here for your end users.</p>
                    </div>
                    <div>
                        <img src="/images/dumbbell.png" alt="Dumbbell Icon" class="w-10 h-10 mt-2" />
                    </div>
                </div>
            </div>
        </Link>
      <div class="bg-white shadow-md rounded-lg p-6 w-full mb-5">
        <h3 class="text-lg font-bold">Card 2 Title</h3>
        <p class="text-gray-600">Content for the second card goes here.</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
