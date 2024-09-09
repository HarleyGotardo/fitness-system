<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

let props = defineProps({
    user_name: String,
    user_role: String,
});
</script>

<template>
  <Head title="Dashboard - Fiber Muscle" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="m-20">
      <div
        class="w-60 bg-gradient-to-l from-slate-300 to-slate-100 text-slate-600 border border-slate-300 grid grid-col-2 justify-center p-4 gap-4 rounded-lg shadow-md"
      >
        <div class="col-span-2 text-lg font-bold capitalize rounded-md">
          Welcome, {{ props.user_name }}
        </div>
        <div class="col-span-2 rounded-md">
          <p v-if="props.user_role === 'admin'" class="text-sm">
            You are logged in as <strong>{{ props.user_role }}</strong>. You can view, create, delete exercises and create, delete, view users.
          </p>
          <p v-else class="text-sm">
            You are logged in as <strong>{{ props.user_role }}</strong>. You can view exercises and your
            profile.
          </p>
        </div>
        <div class="col-span-1">
          <button
            class="rounded-md bg-slate-300 hover:bg-slate-600 hover:text-slate-200 duration-300 p-2"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="feather feather-external-link"
            >
              <path
                d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"
              ></path>
              <polyline points="15 3 21 3 21 9"></polyline>
              <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
