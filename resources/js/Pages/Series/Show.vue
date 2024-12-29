<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { IconDotsVertical, IconTrophy, IconViewfinder, IconMapPin, IconCalendarTime, IconClipboard } from '@tabler/icons-vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import Dropdown from '@/Components/Dropdown.vue'

const props = defineProps({
  serie: {
    type: Object,
    required: true,
  },
})
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
              <DropdownLink :href="route('series.destroy', serie.data.id)">Usuń</DropdownLink>
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
              <article
                class="relative isolate flex overflow-hidden flex-col justify-end rounded-2xl bg-gray-900 size-52 xl:size-44 ml-5 mt-4"
              >
                <img :src="target.image"
                     alt="zdjęcie tarczy numer {{ index + 1 }}"
                     class="absolute inset-0 -z-10 size-52 xl:size-44 object-cover"
                >

                <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10" />

                <h3 class="absolute top-0 right-0 mt-3 mr-3 text-sm font-semibold text-white bg-black/60 px-2 py-1 rounded-lg">
                  {{ target.pointsEarned + target.centerHits / 10 + " / " + target.pointsMax }}
                </h3>
                <h3 class="flex gap-1 absolute top-0 right-0 mt-12 mr-3 text-sm font-semibold text-white bg-black/60 px-2 py-1 rounded-lg">
                  {{ target.centerHits }}
                  <IconViewfinder class="size-5" />
                </h3>
              </article>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
