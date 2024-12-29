<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import InputLabel from '@/Components/Forms/InputLabel.vue'
import TextInput from '@/Components/Forms/TextInput.vue'
import InputError from '@/Components/Forms/InputError.vue'
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue'
import TextArea from '@/Components/Forms/TextArea.vue'
import SecondaryButton from '@/Components/Forms/SecondaryButton.vue'
import Select from '@/Components/Forms/Select.vue'
import UploadFile from "@/Components/Forms/UploadFile.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";

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
  title: 'Trening #' + props.seriesCount + 1,
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
  form.value.targets.push('')
}

const target = ref({
  points: [],
  pointsEarned: 0,
  pointsMax: 0,
  centerHits: 0,
  image: null,
})
</script>

<template>
  <Head title="Nowa seria" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nowa seria</h2>
    </template>
    <template #default>
      <div class="py-6 max-w-7xl mx-auto px-4">
        <form class="mt-6 space-y-6" @submit.prevent="submitForm">
          <div class="flex flex-col sm:flex-row justify-between gap-6">
            <div class="flex-1">
              <InputLabel for="title" value="Tytuł*" />
              <TextInput
                id="title"
                v-model="form.title"
                type="text"
                class="mt-1 block w-full"
                autofocus
              />
              <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="flex-1">
              <InputLabel for="type" value="Typ*" />
              <Select
                v-model="form.type"
                :options="allSeriesTypes"
                class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.type" />
            </div>

            <div class="flex-1">
              <InputLabel for="weapon" value="Broń*" />
              <Select
                v-model="form.weapon"
                :options="allWeaponsTypes"
                class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.weapon" />
            </div>
          </div>

          <div class="flex flex-col sm:flex-row justify-between gap-6">
            <div class="flex-1">
              <InputLabel for="dateTime" value="Data i godzina" />
              <TextInput
                id="dateTime"
                v-model="form.dateTime"
                type="datetime-local"
                class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.dateTime" />
            </div>

            <div class="flex-1">
              <InputLabel for="place" value="Miejsce" />
              <TextInput
                id="place"
                v-model="form.place"
                type="text"
                class="mt-1 block w-full"
              />
              <InputError class="mt-2" :message="form.errors.place" />
            </div>
          </div>

          <div>
            <InputLabel for="coverImage" value="Zdjęcie" />
            <UploadFile
              id="coverImage"
              v-model="form.coverImage"
              class="mt-1 block w-full"
            />
            <InputError class="mt-2" :message="form.errors.coverImage" />
          </div>

          <div>
            <InputLabel for="coverImage" value="Notatki" />
            <TextArea
              id="note"
              v-model="form.note"
              class="mt-1 block w-full"
            />
            <InputError class="mt-2" :message="form.errors.note" />
          </div>

          <PrimaryButton type="button" @click="openTargetModal = true">Dodaj tarczę</PrimaryButton>

          <Modal
            :show="openTargetModal"
            @close="openTargetModal = false"
            class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
          >
            <div class="p-6">
              <h2 class="text-lg font-medium text-gray-900">
                Dodaj tarczę
              </h2>

              <p class="mt-1 text-sm text-gray-600">
                Proszę wprowadź dane tarczy.
              </p>

              <div class="mt-6">
                <InputLabel for="zdjęcieTarczy" value="Zdjęcie tarczy" />
                <UploadFile
                  id="zdjęcieTarczy"
                  v-model="target.image"
                  class="mt-1 block w-full"
                />

                <InputLabel for="punkty" value="Punkty" />
                <TextInput
                  id="punkty"
                  v-model="target.points"
                  type="text"
                  class="mt-1 block w-full"
                />

                <InputLabel for="punktyMax" value="Punkty maksymalne" />
                <TextInput
                  id="punktyMax"
                  v-model="target.pointsMax"
                  type="text"
                  class="mt-1 block w-full"
                />

                <InputLabel for="punktyZa" value="Punkty za" />
                <TextInput
                  id="punktyZa"
                  v-model="target.pointsEarned"
                  type="text"
                  class="mt-1 block w-full"
                />

                <InputLabel for="trafienia" value="Trafienia w środek" />
                <TextInput
                  id="trafienia"
                  v-model="target.centerHits"
                  type="text"
                  class="mt-1 block w-full"
                />

              </div>

              <div class="mt-6 flex justify-end gap-2">
                <SecondaryButton @click="openTargetModal = false">Anuluj</SecondaryButton>
                <PrimaryButton type="button">Dodaj</PrimaryButton>
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
