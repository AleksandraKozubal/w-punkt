<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head} from '@inertiajs/vue3'
import {IconPencil, IconTrash, IconViewfinder} from '@tabler/icons-vue';
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const props = defineProps({
  serie: {
    type: Object,
    required: true,
  },
})
</script>
<template>
  <Head title="Serie"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Serie</h2>
    </template>

    <div class="py-6 max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row px-6 lg:px-8 overflow-hidden sm:rounded-lg gap-4">
        <div class="">
          <img class="h-auto w-full max-w-sm mx-auto sm:h-44 sm:w-auto md:w-auto rounded-lg"
               src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/content-gallery-3.png"
               alt="image description">
        </div>
        <div class="flex flex-col gap-2">
          <div>
            {{ serie.data.type }} | {{ serie.data.dateTime }}
          </div>
          <div class="font-bold text-xl">
            {{ serie.data.title }}
          </div>
          Notatka:
          <div>
            {{ serie.data.note }}
          </div>
        </div>
      </div>
      <div class="py-10">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto grid max-w-2xl grid-cols-1 sm:grid-cols-2 gap-8 overflow-hidden lg:mx-0 lg:max-w-none lg:grid-cols-4">
            <div v-for="target in serie.data.targets" :key="target.id">
              <div class="flex items-center text-sm/6 font-semibold text-orange">
                <svg viewBox="0 0 4 4" class="mr-4 size-1 flex-none" aria-hidden="true">
                  <circle cx="2" cy="2" r="2" fill="currentColor"/>
                </svg>
                <div class="text-xl">
                  #{{ target.id }}
                </div>

                <div
                    class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0"
                    aria-hidden="true"/>
              </div>
              <article class="relative isolate flex overflow-hidden flex-col justify-end rounded-2xl bg-gray-900 size-52 xl:size-44 ml-5 mt-4">
                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/content-gallery-3.png"
                     alt=""
                     class="absolute inset-0 -z-10 size-52 xl:size-44 object-cover"
                />
                <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10" />

                <h3 class="absolute top-0 right-0 mt-3 mr-3 text-sm font-semibold text-white bg-black/60 px-2 py-1 rounded-lg">
                  {{ target.pointsEarned+target.centerHits/10 + " / " + target.pointsMax }}
                </h3>
                <h3 class="flex gap-1 absolute top-0 right-0 mt-12 mr-3 text-sm font-semibold text-white bg-black/60 px-2 py-1 rounded-lg">
                  {{ target.centerHits }}
                  <IconViewfinder class="size-5"/>
                </h3>
              </article>
            </div>
          </div>
        </div>
      </div>
            <div class="flex justify-center gap-4">
              <PrimaryButton class="!p-0 !bg-transparent ring-0 !rounded-full mb-4 mr-1 text-black">
                <IconPencil class="size-6 aspect-square"/> Edytuj
              </PrimaryButton>
              <PrimaryButton class="!p-0 !bg-transparent hover:bg-green !rounded-full mb-4 mr-6 text-black">
                <IconTrash class="size-6 aspect-square"/> Usuń
              </PrimaryButton>
            </div>
    </div>
  </AuthenticatedLayout>
</template>
