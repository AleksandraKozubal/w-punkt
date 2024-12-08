<script setup>
import { computed } from 'vue'
const props = defineProps({
  modelValue: {
    type: [String, Number, Boolean, Array],
    default: null,
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
  <input
    v-model="value"
    type="checkbox"
    class="size-5 text-blue-600 border border-gray-300 rounded-md focus:ring-blue-500 accent-blue-600"
  >
</template>
