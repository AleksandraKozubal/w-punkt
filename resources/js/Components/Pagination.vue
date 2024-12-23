<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  currentPage: {
    type: Number,
    required: true
  },
  lastPage: {
    type: Number,
    required: true
  },
})

const page = computed(() => props.currentPage)
const lastPage = computed(() => props.lastPage)

const pageNumbers = computed(() => {
  const numbers = []
  const total = lastPage.value

  for (let i = 1; i <= total; i++) {
    numbers.push(i)
  }

  return numbers
})
</script>

<template>
  <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
    <div class="-mt-px flex w-0 flex-1">
      <Link v-if="page > 1" :href="`?page=${page - 1}`">
      <button class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        <ArrowLongLeftIcon class="mr-3 size-5 text-gray-400" aria-hidden="true" />
        Poprzednia
      </button>
      </Link>
    </div>

    <div class="hidden md:-mt-px md:flex">
      <Link
          v-for="pageNumber in pageNumbers"
          :key="pageNumber"
          :href="`?page=${pageNumber}`"
          :class="[
          pageNumber === page ? 'border-green text-green' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
          'inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium'
        ]"
          class="cursor-pointer"
      >
        {{ pageNumber }}
      </Link>
    </div>

    <div class="-mt-px flex w-0 flex-1 justify-end">
      <Link v-if="page < lastPage" :href="`?page=${page + 1}`">
      <button class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        Następna
        <ArrowLongRightIcon class="ml-3 size-5 text-gray-400" aria-hidden="true" />
      </button>
      </Link>
    </div>
  </nav>
</template>
