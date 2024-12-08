<script setup lang="ts">
import AppLayout from '../../Layouts/AppLayout.vue'
import FormGroup from '../../Components/Forms/FormGroup.vue'
import TextInput from '../../Components/Forms/TextInput.vue'
import PasswordInput from '../../Components/Forms/PasswordInput.vue'
import FormInlineGroup from '../../Components/Forms/FormInlineGroup.vue'
import FormLabel from '../../Components/Forms/FormLabel.vue'
import Checkbox from '../../Components/Forms/Checkbox.vue'
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '../../Components/Buttons/SecondaryButton.vue'
</script>

<template>
  <AppLayout>
    <div>
      <div class="grow bg-gray-150">
        <div class="h-full mx-auto max-w-8xl px-4 py-6 sm:px-6 lg:px-8">
          <FormGroup class="mt-12">
            <FormLabel>Login</FormLabel>
            <TextInput v-model="name" />

            <FormLabel>Hasło</FormLabel>
            <PasswordInput v-model="password" label="Hasło" />

            <FormInlineGroup>
              <FormLabel>Akceptuję regulamin</FormLabel>
              <Checkbox v-model="acceptRules" />
            </FormInlineGroup>
          </FormGroup>

          <FormGroup class="mt-6">
            <TextArea v-model="comments" label="Uwagi" />

            <FormInlineGroup>
              <div>
                <FormLabel>Miasto</FormLabel>
                <TextInput v-model="city" />
              </div>
              <div>
                <FormLabel>Kod pocztowy</FormLabel>
                <TextInput v-model="postalCode" />
              </div>
            </FormInlineGroup>
          </FormGroup>
          <div class="mx-auto max-w-8xl text-right space-x-4 py-6">
            <SecondaryButton class="w-52">Anuluj</SecondaryButton>
            <PrimaryButton class="w-52">Dodaj</PrimaryButton>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
