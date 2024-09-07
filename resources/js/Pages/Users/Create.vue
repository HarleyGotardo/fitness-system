<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";
import { reactive } from 'vue';

let form = reactive({
    name: '',
    email: '',
    password: '',
    role: '',
});

let submit = () => {
    router.post(route('users.store'), form);
    console.log('Form Submitted');
};
</script>

<template>
    <Head title="Create User - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2>
            </div>
        </template>
        
        <!-- Credentials Section Title -->
        <div class="flex justify-center min-h-screen mt-10">
            <div class="w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">User's Credentials</h3>
                <form @submit.prevent="submit" class="border border-gray-300 shadow-lg p-6 rounded-lg bg-white overflow-y-auto">
                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
                            Name
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
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">
                            Email
                        </label>

                        <input
                            v-model="form.email"
                            type="email"
                            class="border border-gray-400 p-2 w-full rounded-lg"
                            name="email"
                            id="email"
                            required
                        />
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password">
                            Password
                        </label>

                        <input
                            v-model="form.password"
                            type="password"
                            class="border border-gray-400 p-2 w-full rounded-lg"
                            name="password"
                            id="password"
                            required
                        />
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="role">
                            Role
                        </label>

                        <select
                            v-model="form.role"
                            class="border border-gray-400 p-2 w-full rounded-lg"
                            name="role"
                            id="role"
                            required
                        >
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <button
                            type="submit"
                            class="bg-blue-400 text-white rounded-lg px-4 py-2 hover:bg-blue-500"
                        >
                            Create User
                        </button>
                    </div>  
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>