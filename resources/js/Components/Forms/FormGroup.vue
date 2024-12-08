<script setup lang="ts">
defineProps({
  showView: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <div class="xl:space-y-5 border-orange border p-8 rounded-3xl">
    <slot />
  </div>
</template>
