<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'
import { IconTrophy, IconViewfinder, IconCirclePlusFilled, IconTargetOff, IconDotsVertical } from '@tabler/icons-vue'
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import { useToast } from 'vue-toastification'

const toast = useToast()

const props = defineProps({
  series: {
    type: Object,
    required: true,
  },
})


const deleteSerie = (id) => {
  router.delete(route('series.destroy', id), {
    onSuccess: () => {
      series.data = series.data.filter(serie => serie.id !== id)
      toast.success('Seria została usunięta.')
    },
    onError: () => {
      toast.error('Nie udało się usunąć serii.')
    },
  })
}
const { series } = props
</script>

<template>
  <Head title="Serie" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Serie</h2>
    </template>

    <div class="py-6 max-w-7xl mx-auto">
      <div class="flex justify-end">
        <Link :href="route('series.create')">
          <PrimaryButton class="!p-0 !bg-transparent hover:bg-green !rounded-full mb-4 mr-6">
            <IconCirclePlusFilled class="size-12 text-green aspect-square" />
          </PrimaryButton>
        </Link>
      </div>
      <div class="px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <ul v-if="series.data.length !== 0" role="list" class="divide-y divide-gray-100">
          <li v-for="serie in series.data" :key="serie.id"
              class="flex  items-center justify-between gap-x-6 gap-y-4 py-5 sm:flex-nowrap"
          >
            <div class="flex gap-4">
              <div class="flex my-auto">
                <IconTrophy v-if=" serie.type === 'zawody'" class="size-10 text-yellow" />
                <IconViewfinder v-if=" serie.type === 'trening'" class="size-10 text-green" />
              </div>
              <div>
                <p class="text-sm/6 font-semibold text-gray-900">
                  <Link :href="route('series.show', serie.id)"
                        class="hover:underline"
                  >
                    {{ serie.title }}
                  </Link>
                </p>
                <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                  <p>
                    <a :href="serie.dateTime" class="hover:underline">{{ serie.dateTime }}</a>
                  </p>
                  <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                    <circle cx="1" cy="1" r="1" />
                  </svg>
                  <p>
                    {{ serie.type }}
                  </p>
                </div>
              </div>
            </div>
            <dl class="flex flex-none  gap-x-2 sm:w-auto">
              <div class="hidden sm:flex w-full justify-between -space-x-0.5 items-center">
                <dt class="sr-only">Wyniki tarcz</dt>
                <dd v-for="target in serie.targets" :key="target.id">
                  <span
                    class="size-7 bg-orange rounded-full ring-2 ring-white text-white text-xs/5 text-center flex items-center justify-center"
                    :class="{
                      'p-2': target.pointsEarned >= 10 && target.pointsEarned < 100,
                      'px-1 py-2': target.pointsEarned === 100,
                    }"
                  >
                    {{ target.pointsEarned }}
                  </span>
                </dd>
              </div>
              <div class="flex justify-end">
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
                    <DropdownLink :href="route('series.edit', serie.id)">Edytuj</DropdownLink>
                    <button class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                            @click="deleteSerie(serie.id)"
                    >
                      Usuń
                    </button>
                  </template>
                </Dropdown>
              </div>
            </dl>
          </li>
        </ul>
        <div v-else>
          <div class="text-center py-4">
            <IconTargetOff class="size-16 text-orange mx-auto" />
            <h3 class="mt-2 text-sm font-semibold text-gray-900">Brak rekordów</h3>
            <p class="mt-1 text-sm text-gray-500">Dodaj pierwszą serię, aby zacząć śledzić swoje postępy.</p>
          </div>
        </div>
      </div>
      <div class="max-w-7xl mx-auto py-4">
        <Pagination :current-page="series.meta.current_page" :last-page="series.meta.last_page" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>

