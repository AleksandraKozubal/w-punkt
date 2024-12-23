<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head} from '@inertiajs/vue3'
import Pagination from "@/Components/Pagination.vue";
import { IconPencil, IconTrash} from '@tabler/icons-vue';
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const props = defineProps({
  serie: {
    type: Array,
    required: true,
  },
})

const {series} = props;
</script>

<template>
  <Head title="Serie"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Serie</h2>
    </template>

    <div class="py-6 max-w-7xl mx-auto">
      <div class="flex justify-end">
        <PrimaryButton class="!p-0 !bg-transparent ring-0 !rounded-full mb-4 mr-1">
          <IconPencil class="size-8 text-green aspect-square"/>
        </PrimaryButton>
        <PrimaryButton class="!p-0 !bg-transparent hover:bg-green !rounded-full mb-4 mr-6">
          <IconTrash class="size-8 text-red-600 aspect-square"/>
        </PrimaryButton>
      </div>
      <div class="px-6 lg:px-8 overflow-hidden sm:rounded-lg">
        <div>
          <img class="h-auto w-44 transition-all duration-300 rounded-lg cursor-pointer filter grayscale hover:grayscale-0" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/content-gallery-3.png" alt="image description">
        </div>
        <div class="bg-white shadow rounded-lg">
          "ss"
          {{ serie }}
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

