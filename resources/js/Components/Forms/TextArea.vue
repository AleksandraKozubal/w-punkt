<script setup lang="ts">
import { computed } from 'vue'
import FormLabel from './FormLabel.vue'
const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: '',
  },
  label: {
    type: String,
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
    <textarea
      v-model="value"
      type="text"
      rows="3"
      class="block w-full bg-transparent caret-green focus:outline-none focus:border-green focus:ring-1 focus:text-black py-3 px-4 text-base border border-gray-50 text-gray-300 rounded-md focus:ring-green read-only:bg-gray-50 read-only:cursor-default"
    />
  </div>
</template>
