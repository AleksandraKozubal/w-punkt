<template>
  <button
    :disabled="disabled"
    class="inline-flex items-center px-4 py-2 bg-green/90 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green focus:bg-green active:bg-green focus:outline-none focus:ring-2 focus:ring-green focus:ring-offset-2 transition ease-in-out duration-150"
    :class="{'opacity-50 cursor-not-allowed': disabled}"
  >
    <slot />
  </button>
</template>

<script setup>
const props = defineProps({
  disabled: {
    type: Boolean,
    default: false,
  },
})
</script>
