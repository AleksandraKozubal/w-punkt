<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { IconBell, IconMenu2, IconX, IconSettings, IconSunFilled, IconMoonFilled, IconMaximize, IconMinimize } from '@tabler/icons-vue'

const { t } = useI18n()
const sharedProps = usePage().props
const employee = sharedProps.user?.employee

const navigation = computed(() => [
  {
    name:'home',
    href: '/',
    current: usePage().url === '/',
  },
  {
    name: 'settings',
    href: '/settings',
    current: usePage().url === '/settings',
  },
])

const userNavigation = computed(() => [
  { name: t('layout.header.passwordChange'), href: '/password-change' },
  { name: t('layout.header.logout'), href: '/logout', method: 'post' },
])

const title = computed(() => (employee ? `${employee.firstName} ${employee.lastName}` : 'User'))
const subTitle = computed(() => (employee ? employee.email : 'user@example.com'))
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="border-b border-gray-200 bg-white shadow-sm z-10 sticky top-0">
      <div class="flex items-center justify-between max-w-7xl mx-auto p-4">
        <Link href="/" class="flex items-center">
          <img class="h-10" src="identification/sygnet.svg" alt="Ask Well Logo">
        </Link>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-4">
          <Link
            v-for="item in navigation"
            :key="item.name"
            :href="item.href"
            :class="[
              item.current
                ? 'text-primary font-semibold'
                : 'text-gray-700 hover:text-primary',
            ]"
            class="text-sm"
          >
            {{ item.name }}
          </Link>
        </nav>

        <!-- User Actions -->
        <div class="flex items-center space-x-4">
          <button
            type="button"
            class="relative p-2 rounded-full text-gray-700 bg-gray-100 hover:text-primary"
          >
            <IconBell />
          </button>

          <div class="relative">
            <button
              type="button"
              class="relative flex items-center justify-center size-10 rounded-full bg-primary text-white"
            >
              {{ employee?.abbreviation || "U" }}
            </button>

            <!-- Dropdown -->
            <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg">
              <div class="p-4 border-b">
                <div class="font-medium text-gray-800">{{ title }}</div>
                <div class="text-sm text-gray-500">{{ subTitle }}</div>
              </div>
              <div class="py-2">
                <Link
                  v-for="item in userNavigation"
                  :key="item.name"
                  :href="item.href"
                  :method="item.method || 'get'"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md"
                >
                  {{ item.name }}
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="grow bg-gray-50">
      <div class="max-w-7xl mx-auto p-4">
        <slot />
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary-800 text-white py-4">
      <div class="max-w-7xl mx-auto text-center text-sm">
        &copy; 2024 Ask Well. {{ t('layout.footer.version') }}: {{ sharedProps.deployInformation.version }}
        <div>
          Powered by
          <a href="https://www.blumilk.pl" target="_blank" class="hover:underline">Blumilk</a>
        </div>
      </div>
    </footer>
  </div>
</template>
