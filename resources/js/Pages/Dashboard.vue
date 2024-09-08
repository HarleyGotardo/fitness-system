<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

let props = defineProps({
    user_role: String,
});
</script>

<template>
    <Head title="Dashboard - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
    </AuthenticatedLayout>
</template>
