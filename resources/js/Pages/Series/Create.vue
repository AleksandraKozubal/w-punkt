<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head, useForm} from '@inertiajs/vue3'
import { IconDotsVertical, IconTrophy, IconViewfinder } from '@tabler/icons-vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import Dropdown from '@/Components/Dropdown.vue'
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputError from "@/Components/Forms/InputError.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";
import TextArea from "@/Components/Forms/TextArea.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";

const form = useForm({
  title: '',
  type: '',
  dateTime: new Date().toISOString().slice(0, 16),
  coverImage: '',
  note: '',
})
</script>

<template>
  <Head title="Nowa seria" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nowa seria</h2>
    </template>
    <template #default>
      <div class="py-6 max-w-7xl mx-auto">
      <form class="mt-6 space-y-6" @submit.prevent="form.post(route('series.store'))">
        <div class="flex justify-between gap-6">
          <div class="flex-1">
            <InputLabel for="title" value="Tytuł*" />

            <TextInput
                id="title"
                v-model="form.title"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="title"
            />

            <InputError class="mt-2" :message="form.errors.title" />
          </div>

          <div class="flex-1">
            <InputLabel for="type" value="Typ*" />

            <TextInput
                id="type"
                v-model="form.type"
                type="text"
                class="mt-1 block w-full"
                required
                autocomplete="type"
            />

            <InputError class="mt-2" :message="form.errors.type" />
          </div>
        </div>


        <div>
          <InputLabel for="dateTime" value="Data i godzina" />

          <TextInput
            id="dateTime"
            v-model="form.dateTime"
            type="datetime-local"
            class="mt-1 block w-full"
            required
            autocomplete="dateTime"
          />

          <InputError class="mt-2" :message="form.errors.dateTime" />
        </div>

        <div>
          <InputLabel for="coverImage" value="Zdjęcie okładki" />

          <TextInput
            id="coverImage"
            v-model="form.coverImage"
            type="text"
            class="mt-1 block w-full"
            autocomplete="coverImage"
          />

          <InputError class="mt-2" :message="form.errors.coverImage" />
        </div>

        <div>
          <InputLabel for="coverImage" value="Notatki" />

          <TextArea
              id="note"
              v-model="form.note"
              class="mt-1 block w-full"
              autocomplete="note"
          />

          <InputError class="mt-2" :message="form.errors.note" />
        </div>

        <div class="flex justify-end gap-2">
          <SecondaryButton :href="route('series.index')">Anuluj</SecondaryButton>
          <PrimaryButton type="submit">Utwórz</PrimaryButton>
        </div>
      </form>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
