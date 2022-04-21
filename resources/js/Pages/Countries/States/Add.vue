<template>
  <admin-layout title="Dashboard">
    <template #header> Add a Province </template>

    <div class="py-2">
      <div class="mx-auto max-w-7xl">
        <section class="container p-6 mx-auto font-mono">
          <div class="">
          <div class="flex w-full p-2 mb-4">
            <Link
              :href="route('admin.countries.index', country.id)"
              class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-700"
            >
              State or Province Index
            </Link>
          </div>
          <div class="flex w-full p-2 mb-4">
            <Link
              :href="route('admin.countries.index', country.id)"
              class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-700"
            >
             Country Index
            </Link>
          </div>
</div>
          <div
            class="w-full p-6 mb-8 overflow-hidden bg-white rounded-lg shadow-lg sm:max-w-md"
          >
            <form @submit.prevent="submitState">
              <div>
                <jet-label for="name" value="Enter Name of the New Province" />
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


              <div class="flex items-center justify-end mt-4">
                <jet-button
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Add New Province
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
const props = defineProps({
  country: Object,
  state: Object,
});

const form = useForm({
  name: props.state.name,
  
});

function submitState() {
  form.put(`/admin/countries/${props.country.id}/states/${props.state.id}`);
  Inertia.post(
    `/admin/countries/${props.country.id}/states`,
    { seasonNumber: seasonNumber.value },
    {
      onFinish: () => (seasonNumber.value = ""),
    }
  );
}
</script>

<style>
</style>