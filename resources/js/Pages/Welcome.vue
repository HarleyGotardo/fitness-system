<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">

        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                <div class="flex lg:justify-center lg:col-start-2">
                    <img src="/images/muscle.png" alt="Fiber Muscle Logo" class="h-24 w-24">
                </div>
            </header>

            <!-- Welcome Title -->
            <div class="text-center mb-6">
                <h1 class="text-5xl font-extrabold text-black drop-shadow-lg border-b-2 border-gray-300 pb-2">Welcome to Fiber Muscle</h1>
            </div>

            <!-- Login and Register Links -->
            <div class="text-center mt-4">
                <nav v-if="canLogin" class="flex justify-center space-x-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="rounded-md px-4 py-2 text-white bg-green-500 transition-all duration-300 hover:bg-green-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-white border border-white"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="rounded-md px-4 py-2 text-white bg-blue-500 transition-all duration-300 hover:bg-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-white border border-white"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-md px-4 py-2 text-white bg-gray-500 transition-all duration-300 hover:bg-gray-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-white border border-white"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </div>

            <!-- Info Cards -->
            <div class="mt-10 flex justify-center space-x-4">
                <div class="bg-white shadow-lg rounded-lg p-6 max-w-xs">
                    <h2 class="text-xl font-bold mb-2">What is Fiber Muscle?</h2>
                    <p class="text-gray-700">Fiber Muscle is your ultimate fitness companion, helping you achieve your health goals with personalized workout plans and nutrition guides.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 max-w-xs">
                    <h2 class="text-xl font-bold mb-2">Join Our Community</h2>
                    <p class="text-gray-700">Become part of a supportive community that motivates you to stay fit and healthy, sharing tips and experiences along the way.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional styles here if needed */
</style>
