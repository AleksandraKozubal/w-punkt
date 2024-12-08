<script setup lang="ts">
defineProps({
  loading: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  loadingText: {
    type: String,
    default: 'ładowanie',
  },
})
</script>

<template>
  <button
    type="button"
    :disabled="disabled || loading"
    class="inline-flex items-center justify-center border border-2 border-green bg-transparent px-4 h-12 py-3 text-sm font-bold text-green rounded-md hover:border-gray hover:text-gray disabled:bg-gray-700 disabled:opacity-60 focus:outline-none focus:ring-2 focus:ring-gray focus:ring-offset-2"
  >
    <slot v-if="!loading" />
    <template v-else>
      {{ loadingText }}
      <i class="ml-2 fi fi-br-spinner animate-spin" />
    </template>
  </button>
</template>
