<script>
import { defineComponent, toRefs } from 'vue';

export default defineComponent({
  name: 'Table',
  props: {
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
  },
  setup(props) {
    const { columns, data } = toRefs(props);
    return { columns, data };
  }
});
</script>

<template>
    <div class="overflow-x-auto rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th v-for="column in columns" :key="column.key" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              {{ column.label }}
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(row, rowIndex) in data" :key="rowIndex">
            <td v-for="column in columns" :key="column.key" class="px-6 py-4 whitespace-nowrap">
              {{ row[column.key] }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>