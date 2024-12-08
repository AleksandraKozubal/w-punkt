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
    class="size-5 bg-transparent text-green border border-gray rounded-md focus:ring-gray accent-gray"
  >
</template>
