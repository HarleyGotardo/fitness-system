<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';

const props = defineProps({
    users: Array,
    user_id: String,
    search: String,
    noResults: Boolean,
});

const columns = [
    { key: 'id', label: 'ID' },
    { key: 'name', label: 'Name' },
    { key: 'email', label: 'Email' },
    { key: 'role', label: 'Role' },
];

// Form for search
const form = useForm({
    search: props.search || ''
});

// Function to handle search
const handleSearch = () => {
    form.get(route('users.index'), { preserveState: true });
};

// Show SweetAlert if no results are found
if (props.noResults) {
    Swal.fire({
        title: 'No Results',
        text: 'No users found matching your search.',
        icon: 'info',
        confirmButtonText: 'OK'
    });
}
</script>

<template>
    <Head title="Users - Fiber Muscle" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
                <Link v-if="user_id === 'admin'" :href="route('users.create')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                    Create User
                </Link>
            </div>
        </template>

        <div class="m-20 mb-10">
            <Table :columns="columns" :data="props.users" />
        </div>
    </AuthenticatedLayout>
</template>