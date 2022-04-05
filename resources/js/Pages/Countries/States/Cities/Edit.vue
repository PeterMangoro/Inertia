<template>
  <admin-layout title="Dashboard">
    <template #header> City Edit </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.cities.index', [country.id, state.id])"
              class="
                bg-green-500
                hover:bg-green-700
                text-white
                px-4
                py-2
                rounded-lg
              "
            >
              City Index
            </Link>
          </div>

          <div
            class="
              w-full
              mb-8
              sm:max-w-md
              p-6
              overflow-hidden
              bg-white
              rounded-lg
              shadow-lg
            "
          >
            <form @submit.prevent="submitCity">
              <div>
                <jet-label for="name" value="Name" />
                <jet-input
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  autofocus
                  autocomplete="name"
                />
                <div class="text-sm text-red-400" v-if="form.errors.name">
                  {{ form.errors.name }}
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
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, watch, defineProps } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
const props = defineProps({
  country: Object,
  state: Object,
  city: Object,
});

const form = useForm({
  name: props.city.name,
  
});

function submitCity() {
  form.put(
    `/admin/countries/${props.country.id}/states/${props.state.id}/cities/${props.city.id}`
  );
}
</script>

<style>
</style>