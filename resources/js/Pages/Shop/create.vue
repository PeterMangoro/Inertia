<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Product Create
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <jet-form-section @submitted="createProduct">
          <template #title> Create Product </template>

          <template #description> Create your product here. </template>

          <template #form>
            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="title" value="Title" />
              <jet-input
                id="title"
                type="text"
                class="block w-full mt-1"
                v-model="form.title"
                autocomplete="title"
              />
              <jet-input-error :message="form.errors.title" class="mt-2" />
            </div>
            
            <!-- Price -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="price" value="Price" />
              <jet-input
                id="price"
                type="text"
                class="block w-full mt-1"
                v-model="form.price"
                autocomplete="price"
              />
              <jet-input-error :message="form.errors.price" class="mt-2" />
            </div>

            <!-- Image -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="image"    value="Image" />
              <input
                id="image"
                type="file"
                class="block w-full mt-1"
             
            
                
              />
              <jet-input-error :message="form.errors.image" class="mt-2" />
            </div>
            
            

            <!-- Content -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="detail" value="Detail" />
              <textarea
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                v-model="form.detail"
                rows="10"
              ></textarea>
              <jet-input-error :message="form.errors.detail" class="mt-2" />
            </div>
            
          </template>

          <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              Saved.
            </jet-action-message>

            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Save
            </jet-button>
          </template>
        </jet-form-section>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSelect from "@/Components/Select";

export default {
  components: {
    AppLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSelect,
  },

  setup() {
    const form = useForm({
      _method: "POST",
      title: "",
      detail: "",
      price:"",
      image:"",
    });

    const createProduct = () => {
      form.post(route("products.store"));
    };

    return { form, createProduct };
  },
};
</script>
