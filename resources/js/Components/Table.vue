<script setup>
import { ref, defineProps, computed } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const props = defineProps({
  columns: {
    type: Array,
    required: true,
    default: () => []
  },
  data: {
    type: Array,
    required: true,
    default: () => []
  }
});

const columns = ref(props.columns);
const data = ref(props.data);

// Pagination state
const currentPage = ref(1);
const itemsPerPage = 7;

// Search state
const searchQuery = ref('');

// Computed property to get filtered data
const filteredData = computed(() => {
  if (!searchQuery.value) {
    return data.value;
  }
  return data.value.filter(row => {
    return columns.value.some(column => {
      return String(row[column.key]).toLowerCase().includes(searchQuery.value.toLowerCase());
    });
  });
});

// Computed property to get paginated data
const paginatedData = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return filteredData.value.slice(start, end);
});

// Computed property to get total pages
const totalPages = computed(() => {
  return Math.ceil(filteredData.value.length / itemsPerPage);
});

// Method to change page
const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};

// Method to confirm deletion using SweetAlert2
const confirmDelete = (id) => {
  Swal.fire({
    title: 'Are you sure to delete this user?',
    text: "You won't be able to revert this.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete'
  }).then((result) => {
    if (result.isConfirmed) {
      // Proceed with deletion
      axios.delete(route('users.destroy', { id }))
        .then(response => {
          // Handle successful deletion (e.g., refresh the data or show a success message)
          Swal.fire('Deleted!', 'The user has been deleted.', 'success');
          // Optionally, you can refresh the page or update the data
          window.location.reload();
        })
        .catch(error => {
          // Handle error
          Swal.fire('Error!', 'There was an error deleting the user.', 'error');
        });
    }
  });
};
</script>

<template>
  <div class="overflow-x-auto rounded-lg">
    <!-- Search Bar -->
    <div class="relative mb-4">
      <input
        v-model="searchQuery"
        placeholder="Search..."
        class="input shadow-lg focus:border-2 border-gray-300 px-5 py-3 rounded-xl w-56 transition-all focus:w-64 outline-none"
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

    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th v-for="column in columns" :key="column.key" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            {{ column.label }}
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex">
          <td v-for="column in columns" :key="column.key" class="px-6 py-4 whitespace-nowrap">
            {{ row[column.key] }}
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <Link :href="route('users.edit', { id: row.id })">
              <button class="bg-blue-400 text-white px-3 py-1 rounded mr-5">Edit</button>
            </Link>
            <button @click="confirmDelete(row.id)" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="flex justify-between items-center mt-4">
      <button
        @click="changePage(currentPage - 1)"
        :disabled="currentPage === 1"
        class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
      >
        Previous
      </button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button
        @click="changePage(currentPage + 1)"
        :disabled="currentPage === totalPages"
        class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
      >
        Next
      </button>
    </div>
  </div>
</template>