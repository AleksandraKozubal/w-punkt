<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import {
  IconCalendarTime,
  IconClipboard,
  IconMapPin,
  IconPencil,
  IconPlus, IconTarget,
  IconTrash,
} from '@tabler/icons-vue'
import UploadFile from '@/Components/Forms/UploadFile.vue'
import { useToast } from 'vue-toastification'
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue'
import SecondaryButton from '@/Components/Forms/SecondaryButton.vue'
import Select from '@/Components/Forms/Select.vue'
import InputLabel from '@/Components/Forms/InputLabel.vue'
import InputError from '@/Components/Forms/InputError.vue'
import TextInput from '@/Components/Forms/TextInput.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import TextArea from '@/Components/Forms/TextArea.vue'
import { onMounted, ref, watch } from 'vue'
import Modal from '@/Components/Modal.vue'

const toast = useToast()

const props = defineProps({
  serie: {
    type: Object,
    required: true,
  },
  allSeriesTypes: {
    type: Array,
    required: true,
  },
  allWeaponsTypes: {
    type: Array,
    required: true,
  },
})


async function urlToFile(url, filename, mimeType) {
  const response = await fetch(url)
  const data = await response.blob()
  return new File([data], filename, { type: mimeType })
}

const form = useForm({
  id: props.serie.data.id,
  coverImage: null,
  type: props.serie.data.type,
  weapon: props.serie.data.weapon,
  title: props.serie.data.title,
  place: props.serie.data.place,
  dateTime: props.serie.data.dateTime,
  note: props.serie.data.note,
  targets: props.serie.data.targets ?? [],
})


onMounted(async () => {
  if(props.serie.data.coverImage){
    const url = props.serie.data.coverImage
    const filename = url.split('/').pop()
    const mimeType = `image/${filename.split('.').pop()}`

    form.coverImage = await urlToFile(url, filename, mimeType)
  }

  form.targets = await Promise.all(props.serie.data.targets.map(async target => {
    if(target.image){
      const url = target.image
      const filename = url.split('/').pop()
      const mimeType = `image/${filename.split('.').pop()}`
      target.image = await urlToFile(url, filename, mimeType)
    }

    return target
  }))
})


const submitForm = () => {
  form.post(route('series.update', props.serie.data.id), {
    onSuccess: () => {
      form.clearErrors()
      toast.success('Seria została zaktualizowana.')
    },
    onError: () => {
      toast.error('Wystąpił błąd podczas aktualizacji serii.')
    },
  })
}


const openTargetModal = ref(false)
const editingIndex = ref(null)

const removeTarget = (index) => {
  form.targets.splice(index, 1)
}

const editTarget = (index) => {
  editingIndex.value = index
  target.value = {
    points: form.targets[index].points,
    pointsEarned: form.targets[index].pointsEarned,
    pointsMax: form.targets[index].pointsMax,
    centerHits: form.targets[index].centerHits,
    image: form.targets[index].image,
  }
  numberOfPoints.value = target.value.points.length
  openTargetModal.value = true
}


const saveTarget = () => {
  if (editingIndex.value === null) {
    form.targets.push({
      points: target.value.points,
      pointsEarned: target.value.pointsEarned,
      pointsMax: target.value.pointsMax,
      centerHits: target.value.centerHits,
      image: target.value.image,
      imagePreview: target.value.image ? URL.createObjectURL(target.value.image) : null,
    })
  } else {
    form.targets[editingIndex.value] = {
      points: target.value.points,
      pointsEarned: target.value.pointsEarned,
      pointsMax: target.value.pointsMax,
      centerHits: target.value.centerHits,
      image: target.value.image,
      imagePreview: target.value.image ? URL.createObjectURL(target.value.image) : null,
    }
    editingIndex.value = null
  }
  resetTarget()
  openTargetModal.value = false
}

const resetTarget = () => {
  target.value = {
    points: [],
    pointsEarned: 0,
    pointsMax: 0,
    centerHits: 0,
    image: null,
  }
  numberOfPoints.value = 0
}

const numberOfPoints = ref(0)

const target = ref({
  points: [],
  pointsEarned: 0,
  pointsMax: 0,
  centerHits: 0,
  image: null,
})

watch(numberOfPoints, (newVal) => {
  target.value.points = Array.from({ length: newVal }, (_, index) => target.value.points[index] || 0)
  target.value.pointsMax = newVal * 10
})

watch(() => target.value.points, (newVal) => {
  target.value.pointsEarned = newVal.reduce((total, point) => total + (point || 0), 0)
}, { deep: true })

const validateInput = (key, index = null, max = 10) => {
  if (index !== null) {
    const value = target.value[key][index]
    if (!/^\d+$/.test(value) || value < 0) {
      target.value[key][index] = 0
    } else if (value > max) {
      target.value[key][index] = max
    }
  } else {
    const value = target.value[key]
    if (!/^\d+$/.test(value) || value < 0) {
      target.value[key] = 0
    } else if (value > max) {
      target.value[key] = max
    }
  }
}
</script>

<template>
  <Head title="Serie" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edycja serii #{{ serie.data.seriesCount }}</h2>
    </template>

    <div class="py-6 max-w-7xl mx-auto space-y-6">
      <form class="mt-6 space-y-6" @submit.prevent="submitForm">
        <div class="bg-white shadow-sm sm:rounded-2xl py-10">
          <div class="flex flex-col md:flex-row px-6 lg:px-8 overflow-hidden sm:rounded-lg gap-4">
            <div class="m-auto space-y-2">
              <InputLabel for="coverImage" value="Zdjęcie" />
              <UploadFile
                id="coverImage"
                v-model="form.coverImage"
              />
            </div>
            <div class="flex flex-col gap-2 w-full">
              <div class="flex flex-col sm:flex-row justify-between gap-6">
                <div class="flex-1">
                  <InputLabel for="type" value="Typ*" />
                  <Select
                    v-model="form.type"
                    :options="allSeriesTypes"
                  />
                  <InputError class="mt-2" :message="form.errors.type" />
                </div>
                <div class="flex-1">
                  <InputLabel for="weapon" value="Broń*" />
                  <Select
                    v-model="form.weapon"
                    :options="allWeaponsTypes"
                  />
                  <InputError class="mt-2" :message="form.errors.weapon" />
                </div>
              </div>
              <div class="font-bold text-2xl pb-4">
                <InputLabel for="title" value="Tytuł*" />
                <TextInput
                  id="title"
                  v-model="form.title"
                  type="text"
                  class="mt-1 block w-full"
                  autofocus
                />
                <InputError class="mt-2 font-normal" :message="form.errors.title" />
              </div>
              <div class="flex gap-1">
                <IconMapPin class="size-5 text-gray-500 my-auto" />
                <div class="flex-1">
                  <TextInput
                    id="place"
                    v-model="form.place"
                    type="text"
                    class="mt-1 block w-full"
                  />
                  <InputError class="mt-2" :message="form.errors.place" />
                </div>
              </div>
              <div class="flex gap-1">
                <IconCalendarTime class="size-5 text-gray-500 my-auto" />
                <div class="flex-1">
                  <VueDatePicker v-model="form.dateTime" type="datetime" class="py-2" hide-input-icon />
                  <InputError :message="form.errors.dateTime" />
                </div>
              </div>
              <div class="flex gap-1">
                <IconClipboard class="text-gray-500 my-auto size-5" />
                <TextArea
                  id="note"
                  v-model="form.note"
                  class="w-full"
                  :rows="2"
                />
                <InputError class="mt-2" :message="form.errors.note" />
              </div>
            </div>
          </div>
        </div>
        <div class="p-10 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
          <div class="flex flex-wrap gap-8">
            <div v-for="(currentTarget, index) in form.targets" :key="index" class="flex flex-col gap-2">
              <div class="flex justify-between gap-2">
                <div class="text-lg font-semibold text-orange">
                  #{{ index + 1 }}
                </div>
                <div class="flex gap-1">
                  <button
                    type="button"
                    class="text-gray-500 hover:text-gray-700 focus:ring focus:ring-gray-300"
                    @click="editTarget(index)"
                  >
                    <IconPencil class="size-5" />
                  </button>
                  <button
                    type="button"
                    class="text-gray-500 hover:text-gray-700 focus:ring focus:ring-gray-300"
                    @click="removeTarget(index)"
                  >
                    <IconTrash class="size-5" />
                  </button>
                </div>
              </div>
              <div class="flex gap-2">
                <img v-if="currentTarget.image && !currentTarget.imagePreview"
                     :src="'/storage/targets/' + currentTarget.image.name"
                     alt="zdjęcie tarczy"
                     class="size-20 object-cover rounded-lg"
                >
                <img
                  v-else-if="currentTarget.imagePreview"
                  :src="currentTarget.imagePreview"
                  alt="zdjęcie tarczy"
                  class="size-20 object-cover rounded-lg"
                >
                <div v-else class="bg-beige size-20 rounded-lg shrink-0">
                  <IconTarget class="size-16 text-black mt-2 ml-2" />
                </div>
                <div class="flex flex-col gap-2">
                  <div>
                    <span class="font-semibold">Punkty:</span> {{ currentTarget.points }}
                  </div>
                  <div>
                    <span class="font-semibold">Wynik:</span> {{ currentTarget.pointsEarned }}/{{ currentTarget.pointsMax }}
                  </div>
                  <div>
                    <span class="font-semibold">Centralne dziesiątki:</span> {{ currentTarget.centerHits }}
                  </div>
                  <InputError :message="form.errors['targets.' + index + '.points']" />
                  <InputError :message="form.errors['targets.' + index + '.pointsEarned']" />
                  <InputError :message="form.errors['targets.' + index + '.pointsMax']" />
                  <InputError :message="form.errors['targets.' + index + '.centerHits']" />
                  <InputError :message="form.errors['targets.' + index + '.image']" />
                </div>
              </div>
            </div>
            <PrimaryButton type="button" class="h-min !p-2 aspect-square my-auto" title="Dodaj tarczę"
                           @click="openTargetModal = true"
            >
              <IconPlus class="size-5" />
            </PrimaryButton>
          </div>
        </div>

        <Modal
          :show="openTargetModal"
          @close="openTargetModal = false"
        >
          <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
              Dodaj tarczę
            </h2>

            <p class="mt-1 text-sm text-gray-600">
              Podaj informacje takie jak zdobyte punkty, centralne dziesiątki i zdjęcie tarczy.
            </p>

            <div class="mt-6 space-y-6">
              <div>
                <InputLabel for="points" value="Liczba oddanych strzałów*" />
                <Select id="points" v-model="numberOfPoints" :options="[...Array(10).keys()].map(i => i + 1)"
                        class="mt-1 block w-full"
                />
              </div>

              <div v-if="numberOfPoints">
                <div class="flex flex-wrap gap-6">
                  <div
                    v-for="(point, index) in target.points"
                    :key="index"
                    class="flex flex-col items-center"
                  >
                    <InputLabel :for="'point-' + index" class="font-medium">Strzał {{ index + 1 }}</InputLabel>
                    <TextInput
                      :id="'point-' + index"
                      v-model="target.points[index]"
                      type="number"
                      min="0"
                      max="10"
                      class="border border-gray-300 rounded px-2 py-1 w-20"
                      @input="validateInput('points', index)"
                    />
                  </div>
                </div>
              </div>
              <div v-if="numberOfPoints" class="space-y-6">
                <div>
                  <InputLabel for="pointsSum" value="Suma punktów" />
                  <TextInput
                    id="pointsSum"
                    v-model="target.pointsEarned"
                    type="number"
                    min="0"
                    max="{{target.points.length * 10}}"
                    class="mt-1 block w-full"
                    @input="validateInput('pointsEarned', null, target.points.length * 10)"
                  />
                </div>

                <div>
                  <InputLabel for="pointsMax" value="Punkty maksymalne" />
                  <TextInput
                    id="pointsMax"
                    v-model="target.pointsMax"
                    type="number"
                    min="0"
                    max="{{target.points.length * 10}}"
                    class="mt-1 block w-full"
                    @input="validateInput('pointsMax', null, target.points.length * 10)"
                  />
                </div>

                <div>
                  <InputLabel for="central" value="Centralne dziesiątki" />
                  <TextInput
                    id="central"
                    v-model="target.centerHits"
                    type="number"
                    min="0"
                    max="{{target.points.length}}"
                    class="mt-1 block w-full"
                    @input="validateInput('centerHits', null, target.points.length)"
                  />
                </div>

                <div>
                  <InputLabel for="targetImg" value="Zdjęcie tarczy" />
                  <UploadFile
                    id="targetImg"
                    v-model="target.image"
                    class="block mt-1 w-full"
                  />
                </div>
              </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
              <SecondaryButton @click="openTargetModal = false; resetTarget()">Anuluj</SecondaryButton>
              <PrimaryButton :disabled="!numberOfPoints" @click="saveTarget">
                {{ editingIndex === null ? 'Dodaj' : 'Zapisz' }}
              </PrimaryButton>
            </div>
          </div>
        </Modal>

        <div class="flex justify-end gap-2">
          <Link :href="route('series.show', serie.data.id)">
            <SecondaryButton>Anuluj</SecondaryButton>
          </Link>
          <PrimaryButton type="submit">Zapisz</PrimaryButton>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<style>
.dp__theme_light {
  --dp-primary-color: #81B29A;
}
</style>
