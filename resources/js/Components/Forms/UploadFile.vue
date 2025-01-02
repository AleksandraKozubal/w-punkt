<script setup>
import { ref } from 'vue'
import { IconTrash, IconPhotoUp } from '@tabler/icons-vue'

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
  <div class="flex flex-col">
    <input
      ref="input"
      type="file"
      accept="image/jpeg,image/png,image/webp"
      class="hidden"
      @change="handleFileChange"
    >

    <button
      type="button"
      class="border-gray-300 border flex flex-col justify-center items-center bg-white max-w-full text-gray-600 p-4 sm:min-h-[90px] rounded-md shadow-sm hover:text-white hover:bg-green focus:ring focus:ring-green"
      @click="triggerFileDialog"
    >
      <IconPhotoUp class="size-4" />
      Wybierz zdjęcie
      <span class="text-xs">Dopuszczalne formaty: JPG, JPEG, PNG, WEBP</span>
    </button>

    <div v-if="model" class="flex items-center justify-self-start text-sm text-gray-500 mt-2">
      <span>Wybrano: {{ model.name }}</span>
      <button
        type="button"
        class="ml-4 text-red-500 hover:text-red-700 focus:ring focus:ring-red-300"
        @click="clearFile"
      >
        <IconTrash class="size-5" />
      </button>
    </div>

    <div v-if="preview" class="mt-2 relative">
      <img :src="preview" alt="Preview" class="max-w-full sm:max-w-80 h-auto border rounded-md shadow-sm">
    </div>
  </div>
</template>
