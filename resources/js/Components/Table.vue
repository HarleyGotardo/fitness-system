<script setup>
import { ref, defineProps, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

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

// Computed property to get paginated data
const paginatedData = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return data.value.slice(start, end);
});

// Computed property to get total pages
const totalPages = computed(() => {
  return Math.ceil(data.value.length / itemsPerPage);
});

// Method to change page
const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};
</script>

<template>
    <div class="overflow-x-auto rounded-lg">
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
              <!-- <Link>
                <button class="bg-blue-500 text-white px-3 py-1 rounded mr-2">Edit</button>
              </Link> -->
              <Link :href="route('users.destroy', { id: row.id })" method="delete" as="button">
                <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
              </Link>
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