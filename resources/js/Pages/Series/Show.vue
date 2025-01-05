<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router } from '@inertiajs/vue3'
import { IconDotsVertical, IconTrophy, IconViewfinder, IconMapPin, IconCalendarTime, IconClipboard, IconTarget } from '@tabler/icons-vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import Dropdown from '@/Components/Dropdown.vue'
import { useToast } from 'vue-toastification'
import { ref } from 'vue'
import UploadFile from '@/Components/Forms/UploadFile.vue'
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue'
import SecondaryButton from '@/Components/Forms/SecondaryButton.vue'
import Select from '@/Components/Forms/Select.vue'
import TextInput from '@/Components/Forms/TextInput.vue'
import Modal from '@/Components/Modal.vue'
import InputLabel from '@/Components/Forms/InputLabel.vue'

const toast = useToast()
const openTargetModal = ref(false)
const shownTarget = ref()


const props = defineProps({
  serie: {
    type: Object,
    required: true,
  },
})

const deleteSerie = (id) => {
  router.delete(route('series.destroy', id), {
    onSuccess: () => {
      toast.success('Seria została usunięta.')
    },
    onError: () => {
      toast.error('Nie udało się usunąć serii.')
    },
  })
}

const showTargetDetails = (target) => {
  openTargetModal.value = true
  shownTarget.value = props.serie.data.targets[target]
}
</script>

<template>
  <Head title="Serie" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Seria #{{ serie.data.seriesCount }}</h2>
    </template>

    <div class="py-6 max-w-7xl mx-auto space-y-6">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl pb-10">
        <div class="px-6 py-2 flex justify-end">
          <Dropdown align="right" width="48">
            <template #trigger>
              <span class="inline-flex rounded-md">
                <button
                  type="button"
                  class="inline-flex items-center p-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                >
                  <IconDotsVertical class="size-4" />
                </button>
              </span>
            </template>

            <template #content>
              <DropdownLink :href="route('series.edit', serie.data.id)">Edytuj</DropdownLink>
              <button class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                      @click="deleteSerie(serie.data.id)"
              >
                Usuń
              </button>
            </template>
          </Dropdown>
        </div>

        <div class="flex flex-col md:flex-row px-6 lg:px-8 overflow-hidden sm:rounded-lg gap-4">
          <div class="my-auto">
            <img v-if="serie.data.coverImage"
                 class="h-auto w-full max-w-sm mx-auto sm:h-44 sm:w-auto md:w-auto rounded-lg"
                 :src="serie.data.coverImage"
                 alt="zdjęcie użytownika"
            >
            <IconViewfinder v-else-if="serie.data.type === 'trening'" class="size-20 text-green" />
            <IconTrophy v-else class="size-20 text-yellow" />
          </div>
          <div class="flex flex-col gap-2">
            <div class="text-sm">
              {{ serie.data.type }} | {{ serie.data.weapon }}
            </div>
            <div class="font-bold text-2xl capitalize">
              {{ serie.data.title }}
            </div>
            <div class="flex flex-col gap-2">
              <div v-if="serie.data.place" class="flex gap-1"><IconMapPin class="size-5 text-gray-500" />{{ serie.data.place }}</div>
              <div v-if="serie.data.dateTime" class="flex gap-1"><IconCalendarTime class="size-5 text-gray-500" />{{ serie.data.dateTime }}</div>
              <div v-if="serie.data.note" class="flex gap-1">
                <IconClipboard class="text-gray-500" style="width: 25px; height: 20px;" />
                {{ serie.data.note }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="!!serie.data.targets" class="py-10 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div
            class="mx-auto grid max-w-2xl grid-cols-1 sm:grid-cols-2 gap-8 overflow-hidden lg:mx-0 lg:max-w-none lg:grid-cols-4"
          >
            <div v-for="(target, index) in serie.data.targets" :key="target.id" class="mx-auto">
              <div class="flex items-center text-sm/6 font-semibold text-orange">
                <svg viewBox="0 0 4 4" class="mr-4 size-1 flex-none" aria-hidden="true">
                  <circle cx="2" cy="2" r="2" fill="currentColor" />
                </svg>
                <div class="text-xl">
                  #{{ index + 1 }}
                </div>
                <div
                  class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0"
                  aria-hidden="true"
                />
              </div>
              <a class="relative block cursor-pointer" @click="showTargetDetails(index)">
                <article class="relative isolate flex overflow-hidden flex-col justify-end rounded-2xl bg-beige size-52 xl:size-44 ml-5 mt-4">
                  <img v-if="target.image"
                       :src="target.image"
                       alt="zdjęcie tarczy"
                       class="absolute inset-0 -z-10 size-52 xl:size-44 object-cover"
                  >
                  <div v-else class="absolute inset-0 -z-10 size-52 xl:size-44 object-cover top-1/4">
                    <IconTarget class="size-24 text-black mx-auto" />
                  </div>

                  <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-800/10" />

                  <h3 class="absolute top-0 right-0 mt-3 mr-3 text-sm font-semibold text-white bg-black/60 px-2 py-1 rounded-lg">
                    {{ target.pointsEarned + " / " + target.pointsMax }}
                  </h3>
                  <h3 class="flex gap-1 absolute top-0 right-0 mt-12 mr-3 text-sm font-semibold text-white bg-black/60 px-2 py-1 rounded-lg">
                    {{ target.centerHits }}
                    <IconViewfinder class="size-5" />
                  </h3>
                </article>
              </a>
            </div>
          </div>
        </div>
      </div>
      <Modal
        :show="openTargetModal"
        @close="openTargetModal = false"
      >
        <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900">
            Szczegóły tarczy
          </h2>

          <!--          <p class="mt-1 text-sm text-gray-600">-->
          <!--            Podaj informacje takie jak zdobyte punkty, centralne dziesiątki i zdjęcie tarczy.-->
          <!--          </p>-->

          <div class="mt-6 space-y-6">
            <div class="flex flex-wrap justify-center gap-6">
              <div
                v-for="(point, index) in shownTarget.points"
                :key="index"
                class="flex flex-col items-center px-1"
              >
                <InputLabel :for="'point-' + index" class="font-medium">{{ index + 1 }}.</InputLabel>
                <div class="border border-gray-300 rounded px-2 py-1">
                  {{ shownTarget.points[index] }}
                </div>
              </div>
            </div>
            <div class="space-y-6">
              <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <div class="flex gap-2 items-center">
                  <InputLabel for="pointsSum" value="Suma punktów" />
                  <div class="border border-gray-300 rounded-md px-2 py-1 size-fit">
                    {{ shownTarget.pointsEarned }}
                  </div>
                </div>
                <div class="flex gap-2 items-center">
                  <InputLabel for="pointsMax" value="Punkty maksymalne" />
                  <div class="border border-gray-300 rounded-md px-2 py-1 size-fit">
                    {{ shownTarget.pointsMax }}
                  </div>
                </div>

                <div class="flex gap-2 items-center">
                  <InputLabel for="central" value="Centralne dziesiątki" />
                  <div class="border border-gray-300 rounded-md px-2 py-1 size-fit">{{ shownTarget.centerHits }}</div>
                </div>
              </div>
              <div v-if="shownTarget.image" class="flex flex-col items-center">
                <InputLabel for="targetImg" value="Zdjęcie tarczy" />
                <img :src="shownTarget.image"
                     alt="zdjęcie tarczy"
                     class="mt-2 max-w-44 rounded-lg"
                >
              </div>
            </div>
          </div>

          <div class="mt-6 flex justify-end gap-2">
            <PrimaryButton @click="openTargetModal = false">Zamknij</PrimaryButton>
          </div>
        </div>
      </Modal>
    </div>
  </AuthenticatedLayout>
</template>
