<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    users: Array,
});

const columns = [
    { key: 'id', label: 'ID' },
    { key: 'name', label: 'Name' },
    { key: 'email', label: 'Email' },
    { key: 'role', label: 'Role' },
];
</script>

<template>
    <Head title="Users - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
                <Link :href="route('users.create')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                    Create User
                </Link>
            </div>
        </template>

        <div class="m-20 mb-10">
            <Table :columns="columns" :data="props.users" />
        </div>
    </AuthenticatedLayout>
</template>