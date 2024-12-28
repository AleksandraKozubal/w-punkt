<script setup>
import { computed } from 'vue'

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
        rows="3"
        class="border-gray-300 focus:border-green focus:ring-green rounded-md shadow-sm block w-full bg-white text-black caret-orange focus:outline-none focus:ring-1 py-2 px-3 text-base border"
    />
  </div>
</template>
