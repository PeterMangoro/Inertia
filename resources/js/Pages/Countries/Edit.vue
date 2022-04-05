<template>
  <admin-layout title="Dashboard">
    <template #header> Country Edit </template>

    <div class="py-2">
      <div class="mx-auto max-w-7xl">
        <section class="container p-6 mx-auto font-mono">
          <div class="flex w-full p-2 mb-4">
            <Link
              :href="route('admin.countries.index')"
              class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-700"
            >
              Go Back to Country Index
            </Link>
          </div>

          <div
            class="w-full p-6 mb-8 overflow-hidden bg-white rounded-lg shadow-lg sm:max-w-md"
          >
            <form @submit.prevent="submitCountry">
              <div>
                <jet-label for="name" value="Name" />
                <jet-input
                  id="name"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.name"
                  autofocus
                  autocomplete="name"
                />
                <div class="text-sm text-red-400" v-if="form.errors.name">
                  {{ form.errors.name }}
                </div>
              </div>

              <div class="mt-4">
                <jet-label for="iso3" value="Iso3" />
                <jet-input
                  id="iso3"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.iso3"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.iso3"
                >
                  {{ form.errors.iso3 }}
                </div>
              </div>

<div class="mt-4">
                <jet-label for="phonecode" value="Phonecode" />
                <jet-input
                  id="phonecode"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.phonecode"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.phonecode"
                >
                  {{ form.errors.phonecode }}
                </div>
              </div>

<div class="mt-4">
                <jet-label for="capital" value="Capital" />
                <jet-input
                  id="capital"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.capital"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.capital"
                >
                  {{ form.errors.capital }}
                </div>
              </div>
              
              <div class="mt-4">
                <jet-label for="currency" value="Currency" />
                <jet-input
                  id="currency"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.currency"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.currency"
                >
                  {{ form.errors.currency }}
                </div>
              </div>
              
              <div class="flex items-center justify-end mt-4">
                <jet-button
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Update
                </jet-button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </admin-layout>
</template>

<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, watch, defineProps } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
const props = defineProps({
  country: Object,
});

const form = useForm({
  name: props.country.name,
  iso3: props.country.iso3,
  phonecode: props.country.phonecode,
  capital: props.country.capital,
  currency: props.country.currency,
});

function submitCountry() {
  form.put(`/admin/countries/${props.country.id}`);
}
</script>

<style>
</style>