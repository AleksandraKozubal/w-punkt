<script setup>
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
})
</script>

<template>
  <Head title="Witaj" />

  <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div class="overflow-hidden 2xl:overflow-visible">
      <div class="mx-auto max-w-7xl px-6 pb-32 pt-36 sm:pt-60 lg:px-8 lg:pt-32">
        <div class="mx-auto max-w-2xl gap-x-14 lg:mx-0 lg:flex lg:max-w-none lg:items-center">
          <div class="relative w-full lg:max-w-xl lg:shrink-0 xl:max-w-2xl">
            <h1 class="text-pretty text-5xl font-semibold tracking-tight text-green sm:text-7xl">
              Celuj w doskonałość
            </h1>
            <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:max-w-md sm:text-xl/8 lg:max-w-none">
              Rejestruj każdy trening i śledź swoje postępy w strzelectwie.
              Analizuj wyniki, by udoskonalać technikę i precyzję strzałów.
              Osiągaj nowe cele i rozwijaj się na każdym etapie drogi.
            </p>
            <div class="mt-10 flex items-center gap-x-6">
              <div v-if="canLogin" class="p-6 text-end">
                <Link
                  v-if="$page.props.auth.user"
                  :href="route('dashboard')"
                  class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >
                  Dashboard
                </Link>
                <template v-else>
                  <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                  >
                    Logowanie
                  </Link>

                  <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                  >
                    Rejestracja
                  </Link>
                </template>
              </div>
            </div>
          </div>
          <div class="mt-14 flex justify-end gap-8 sm:-mt-44 sm:justify-start sm:pl-20 lg:mt-0 lg:pl-0">
            <div
              class="ml-auto w-44 flex-none space-y-8 pt-32 sm:ml-0 sm:pt-80 lg:order-last lg:pt-36 xl:order-none xl:pt-80"
            >
              <div class="relative">
                <img src="/photos/gun.avif"
                     alt="Pneumatic Rifle"
                     class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out"
                >
                <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10" />
              </div>
            </div>

            <div class="mr-auto w-44 flex-none space-y-8 sm:mr-0 sm:pt-52 lg:pt-36">
              <div class="relative">
                <img
                  src="/photos/targets.avif"
                  alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg  hover:scale-105 transition-transform duration-300 ease-in-out"
                >
                <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10" />
              </div>
              <div class="relative">
                <img
                  src="/photos/target.avif"
                  alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg  hover:scale-105 transition-transform duration-300 ease-in-out"
                >
                <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10" />
              </div>
            </div>
            <div class="w-44 flex-none space-y-8 pt-32 sm:pt-0">
              <div class="relative">
                <img
                  src="/photos/pneumatic-riffle.avif"
                  alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out"
                >
                <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10" />
              </div>
              <div class="relative">
                <img
                  src="/photos/gun-pointing.avif"
                  alt="" class="aspect-[2/3] w-full rounded-xl bg-gray-900/5 object-cover shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out"
                >
                <div class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-inset ring-gray-900/10" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
