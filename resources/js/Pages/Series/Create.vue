<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head, Link, useForm} from '@inertiajs/vue3'
import InputLabel from '@/Components/Forms/InputLabel.vue'
import TextInput from '@/Components/Forms/TextInput.vue'
import InputError from '@/Components/Forms/InputError.vue'
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue'
import TextArea from '@/Components/Forms/TextArea.vue'
import SecondaryButton from '@/Components/Forms/SecondaryButton.vue'
import Select from '@/Components/Forms/Select.vue'
import UploadFile from "@/Components/Forms/UploadFile.vue";
import {ref, watch} from "vue";
import Modal from "@/Components/Modal.vue";
import {IconPlus, IconTrash, IconPencil} from "@tabler/icons-vue";

const props = defineProps({
  allWeaponsTypes: {
    type: Array,
    required: true,
  },
  allSeriesTypes: {
    type: Array,
    required: true,
  },
  seriesCount: {
    type: Number,
    required: true,
  },
})

const form = useForm({
  title: 'Trening #' + ++props.seriesCount,
  dateTime: new Date().toISOString().slice(0, 16),
  place: '',
  coverImage: null,
  note: '',
  type: '',
  weapon: '',
  targets: [],
})

const submitForm = () => {
  form.post(route('series.store'), {
    onSuccess: () => {
      form.clearErrors()
    },
  })
}

const openTargetModal = ref(false)


const addTarget = () => {
  form.targets.push({
    points: target.value.points,
    pointsEarned: target.value.pointsEarned,
    pointsMax: target.value.pointsMax,
    centerHits: target.value.centerHits,
    image: target.value.image,
  })
}

const removeTarget = (index) => {
  form.targets.splice(index, 1)
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
  target.value.points = Array.from({ length: newVal }, (_, index) => target.value.points[index] || 0);
})

watch(target.value.points, (newVal) => {
  target.value.pointsEarned = newVal.reduce((acc, curr) => acc + curr, 0);
})
</script>

<template>
  <Head title="Nowa seria"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nowa seria</h2>
    </template>
    <template #default>
      <div class="py-6 max-w-7xl mx-auto px-4">
        <form class="mt-6 space-y-6" @submit.prevent="submitForm">
          <h2 class="text-lg font-medium text-green">Dane podstawowe</h2>
          <div class="flex flex-col sm:flex-row justify-between gap-6">
            <div class="flex-1">
              <InputLabel for="title" value="Tytuł*"/>
              <TextInput
                  id="title"
                  v-model="form.title"
                  type="text"
                  class="mt-1 block w-full"
                  autofocus
              />
              <InputError class="mt-2" :message="form.errors.title"/>
            </div>

            <div class="flex-1">
              <InputLabel for="type" value="Typ*"/>
              <Select
                  v-model="form.type"
                  :options="allSeriesTypes"
                  class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.type"/>
            </div>

            <div class="flex-1">
              <InputLabel for="weapon" value="Broń*"/>
              <Select
                  v-model="form.weapon"
                  :options="allWeaponsTypes"
                  class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.weapon"/>
            </div>
          </div>

          <div class="flex flex-col sm:flex-row justify-between gap-6">
            <div class="flex-1">
              <InputLabel for="dateTime" value="Data i godzina"/>
              <TextInput
                  id="dateTime"
                  v-model="form.dateTime"
                  type="datetime-local"
                  class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.dateTime"/>
            </div>

            <div class="flex-1">
              <InputLabel for="place" value="Miejsce"/>
              <TextInput
                  id="place"
                  v-model="form.place"
                  type="text"
                  class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.place"/>
            </div>
          </div>

          <div class="flex flex-col sm:flex-row justify-between gap-6">
            <div class="sm:w-1/2">
              <InputLabel for="coverImage" value="Zdjęcie"/>
              <UploadFile
                  id="coverImage"
                  v-model="form.coverImage"
                  class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.coverImage"/>
            </div>

            <div class="sm:w-1/2">
              <InputLabel for="coverImage" value="Notatki"/>
              <TextArea
                  id="note"
                  v-model="form.note"
                  class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.note"/>
            </div>
          </div>

          <div>
            <h2 class="text-lg font-medium text-green">
              Tarcze
            </h2>

            <div class="flex flex-wrap gap-8">
              <div v-for="(target, index) in form.targets" :key="index" class="flex flex-col gap-2">
                <div class="flex justify-between gap-2">
                  <div class="text-lg font-semibold text-orange">
                    #{{ index + 1 }}
                  </div>
                  <div class="flex gap-1">
                    <button
                        type="button"
                        @click="editTarget(index)"
                        class="text-gray-500 hover:text-gray-700 focus:ring focus:ring-gray-300"
                    >
                      <IconPencil class="size-5" />
                    </button>
                    <button
                        type="button"
                        @click="removeTarget(index)"
                        class="text-gray-500 hover:text-gray-700 focus:ring focus:ring-gray-300"
                    >
                      <IconTrash class="size-5" />
                    </button>
                  </div>
                </div>
                <div class="flex gap-2">
                  <img
                      v-if="target.image"
                      :src="target.image"
                      alt="zdjęcie tarczy"
                      class="h-20 w-20 object-cover rounded-lg"
                  />
                  <div class="flex flex-col gap-2">
                    <div>
                      <span class="font-semibold">Punkty:</span> {{ target.points }}
                    </div>
                    <div>
                      <span class="font-semibold">Punkty maksymalne:</span> {{ target.pointsMax }}
                    </div>
                    <div>
                      <span class="font-semibold">Suma punktów:</span> {{ target.pointsEarned }}
                    </div>
                    <div>
                      <span class="font-semibold">Trafienia w środek:</span> {{ target.centerHits }}
                    </div>
                  </div>
                </div>
              </div>
              <PrimaryButton type="button" @click="openTargetModal = true" class="h-min !p-2 aspect-square my-auto"  title="Dodaj tarczę">
                <IconPlus class="size-5"/>
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
                  <InputLabel for="zdjęcieTarczy" value="Zdjęcie tarczy"/>
                  <UploadFile
                      id="zdjęcieTarczy"
                      v-model="target.image"
                      class="block w-full"
                  />
                </div>

                <div>
                  <InputLabel for="punkty" value="Punkty"/>
                  <Select id="punkty" v-model="numberOfPoints" :options="[1, 2, 3, 4, 5, 6, 7, 8, 9, 10]"
                          class="mt-1 block w-full"/>
                </div>

                <div>
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
                      />
                    </div>
                  </div>
                </div>

                <div>
                  <InputLabel for="sumaPunktów" value="Suma punktów"/>
                  <TextInput
                      id="sumaPunktów"
                      v-model="target.pointsEarned"
                      type="text"
                      class="mt-1 block w-full"
                  />
                </div>

                <div>
                  <InputLabel for="punktyMax" value="Punkty maksymalne"/>
                  <TextInput
                      id="punktyMax"
                      v-model="target.pointsMax"
                      type="text"
                      class="mt-1 block w-full"
                  />
                </div>

                <div>
                  <InputLabel for="punktyZa" value="Punkty za"/>
                  <TextInput
                      id="punktyZa"
                      v-model="target.pointsEarned"
                      type="text"
                      class="mt-1 block w-full"
                  />
                </div>

                <div>
                  <InputLabel for="trafienia" value="Trafienia w środek"/>
                  <TextInput
                      id="trafienia"
                      v-model="target.centerHits"
                      type="text"
                      class="mt-1 block w-full"
                  />
                </div>
              </div>

              <div class="mt-6 flex justify-end gap-2">
                <SecondaryButton @click="openTargetModal = false">Anuluj</SecondaryButton>
                <PrimaryButton @click="addTarget">Dodaj</PrimaryButton>
              </div>
            </div>
          </Modal>

          <div class="flex justify-end gap-2">
            <Link :href="route('series.index')">
              <SecondaryButton>Anuluj</SecondaryButton>
            </Link>
            <PrimaryButton type="submit">Utwórz</PrimaryButton>
          </div>
        </form>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
