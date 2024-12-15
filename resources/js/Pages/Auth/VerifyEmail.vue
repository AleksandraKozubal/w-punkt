<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/Forms/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600">
          Dziękujemy za zapisanie się! Czy przed rozpoczęciem możesz zweryfikować swój adres e-mail, klikając link
          właśnie wysłaliśmy do Ciebie e-mail? Jeśli nie otrzymałeś wiadomości e-mail, z przyjemnością wyślemy Ci kolejną.
        </div>

        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
          Na adres e-mail podany podczas rejestracji został wysłany nowy link weryfikacyjny.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Wyślij ponownie e-mail weryfikacyjny
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green"
                    >Wyloguj</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>
