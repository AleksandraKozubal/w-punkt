<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/Forms/InputError.vue'
import InputLabel from '@/Components/Forms/InputLabel.vue'
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue'
import TextInput from '@/Components/Forms/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
  status: {
    type: String,
    default: '',
  },
})

const form = useForm({
  email: '',
})

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
      Zapomniałeś hasła? Bez problemu. Wystarczy, że podasz nam swój adres e-mail, a my wyślemy Ci wiadomość e-mail z resetem hasła
      link, który pozwoli Ci wybrać nowy.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Wyślij link do resetu hasła
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
