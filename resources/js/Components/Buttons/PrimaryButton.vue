<script setup>
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
    class="inline-flex justify-center py-3 px-4 h-12 border-2 border-green rounded-md text-sm font-semibold text-beige bg-green hover:bg-gray hover:border-gray focus:outline-none focus:ring-2 focus:ring-gray focus:ring-offset-2 disabled:opacity-60 disabled:hover:bg-gray"
  >
    <slot v-if="!loading" />
    <template v-else>
      {{ loadingText }}
      <i class="ml-2 fi fi-br-spinner animate-spin" />
    </template>
  </button>
</template>
