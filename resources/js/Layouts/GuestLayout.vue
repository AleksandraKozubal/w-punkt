<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
      <Link href="/">
        <div class="flex items-center">
          <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
          <div class="flex flex-col ms-2 text-green font-bold leading-tight">
            <div class="block">W</div>
            <div class="block">PUNKT</div>
          </div>
        </div>
      </Link>
    </div>

    <div
      class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>
