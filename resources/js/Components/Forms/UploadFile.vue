<script setup>
import { ref } from 'vue'
import { IconTrash } from '@tabler/icons-vue'

const model = defineModel({
  type: File,
  required: false,
})

const input = ref(null)
const preview = ref(null)

const handleFileChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    model.value = file

    const reader = new FileReader()
    reader.onload = (e) => {
      preview.value = e.target.result
    }
    reader.readAsDataURL(file)
  } else {
    clearFile()
  }
}

const triggerFileDialog = () => {
  input.value.click()
}

const clearFile = () => {
  model.value = null
  preview.value = null
  if (input.value) {
    input.value.value = ''
  }
}
</script>

<template>
  <div class="flex flex-col space-y-4">
    <input
        ref="input"
        type="file"
        accept="image/*"
        @change="handleFileChange"
        class="hidden"
    />

    <button
        type="button"
        @click="triggerFileDialog"
        class="border-gray-300 border bg-white max-w-full sm:max-w-96 text-black py-2 sm:h-20 px-4 rounded-md shadow-md hover:text-white hover:bg-green focus:ring focus:ring-green"
    >
      Wybierz zdjęcie
    </button>

    <div v-if="model" class="flex items-center justify-self-start text-sm text-gray-500 mt-2">
      <span>Wybrano: {{ model.name }}</span>
      <button
          type="button"
          @click="clearFile"
          class="ml-4 text-red-500 hover:text-red-700 focus:ring focus:ring-red-300"
      >
        <IconTrash class="size-5" />
      </button>
    </div>

    <div v-if="preview" class="mt-2 relative">
      <img :src="preview" alt="Preview" class="max-w-full sm:max-w-80 h-auto border rounded-md shadow-sm"/>
    </div>
  </div>
</template>
