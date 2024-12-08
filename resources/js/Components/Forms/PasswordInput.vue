<script setup lang="ts">
import { computed } from 'vue'
import FormLabel from './FormLabel.vue'
const props = defineProps({
  modelValue: {
    type: [String],
    default: '',
  },
})
const emit = defineEmits(['update:modelValue'])
const value = computed({
  get: () => props.modelValue,
  set: (value) => {
    emit('update:modelValue', value)
  },
})
</script>

<template>
  <div>
    <input
      v-model.trim="value"
      type="password"
      class="block w-full bg-transparent caret-green focus:outline-none focus:border-green focus:ring-1 focus:text-black py-3 px-4 text-base border border-gray text-green rounded-md"
    >
  </div>
</template>
