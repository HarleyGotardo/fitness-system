<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";
import { reactive } from 'vue';
import Swal from 'sweetalert2';

let form = reactive({
    name: '',
    description: '',
    content: '',
});

let submit = () => {
    router.post(route('exercises.store'), form, {
        onSuccess: () => {
            Swal.fire({
                title: 'Exercise Created',
                text: 'The exercise has been successfully created.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        },
        onError: () => {
            Swal.fire({
                title: 'Error',
                text: 'There was an error creating the exercise.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
    console.log('Form Submitted');
};
</script>

<template>
    <Head title="Create Exercises - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Exercise</h2>
            </div>
        </template>

        <!-- Credentials Section Title -->
        <div class="flex justify-center min-h-screen mt-10">
            <div class="w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Exercise Details</h3>
                <form @submit.prevent="submit" class="border border-gray-300 shadow-lg p-6 rounded-lg bg-white overflow-y-auto">
                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
                            Exercise Name
                        </label>

                        <input
                            v-model="form.name"
                            type="text"
                            class="border border-gray-400 p-2 w-full rounded-lg"
                            name="name"
                            id="name"
                            required
                        />
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="description">
                            Exercise Description
                        </label>

                        <textarea
                            v-model="form.description"
                            type="text"
                            class="border border-gray-400 p-2 w-full rounded-lg"
                            name="description"
                            id="description"
                            required
                        />
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="content">
                            Exercise Content
                        </label>

                        <textarea
                            v-model="form.content"
                            type="text"
                            class="border border-gray-400 p-2 w-full h-40 rounded-lg"
                            name="content"
                            id="content"
                            required
                        />
                    </div>
                    
                    <div class="mb-6">
                        <button
                            type="submit"
                            class="bg-blue-400 text-white rounded-lg px-4 py-2 hover:bg-blue-500"
                        >
                            Create Exercise
                        </button>
                    </div>  
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>