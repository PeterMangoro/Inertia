<template>
  <admin-layout title="Dashboard">
    <template #header> Blog Edit </template>

    <div class="py-2">
      <div class="mx-auto max-w-7xl">
        <section class="container p-6 mx-auto font-mono">
          <div class="flex w-full p-2 mb-4">
            <Link
              :href="route('admin.blogs.index')"
              class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-700"
            >
              Blog Index
            </Link>
          </div>

          <div
            class="w-full p-6 mb-8 overflow-hidden bg-white rounded-lg shadow-lg sm:max-w-md"
          >
            <form @submit.prevent="submitBlog">
              <div>
                <jet-label for="title" value="Title" />
                <jet-input
                 
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.title"
                  autofocus
                  autocomplete="title"
                />
                <div class="text-sm text-red-400" v-if="form.errors.title">
                  {{ form.errors.title }}
                </div>
              </div>

              <div>
                <jet-label for="detail" value="Detail" />
                <textarea
                  id="detail"
                  type="text"
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  v-model="form.detail"
                  autofocus
                  autocomplete="detail"
                />
                <div class="text-sm text-red-400" v-if="form.errors.detail">
                  {{ form.errors.detail }}
                </div>
              </div>
              
              <div class="mt-4">
                <jet-label for="image" value="Image" />
                <jet-input
                  id="image"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.image"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.image"
                >
                  {{ form.errors.image }}
                </div>
              </div>

             
              <div class="mt-4">
                <label class="flex items-center">
                  <jet-checkbox
                    name="is_public"
                    v-model:checked="form.is_public"
                  />
                  <span class="ml-2 text-sm text-gray-600">Public</span>
                </label>
                <div class="text-sm text-red-400" v-if="form.errors.is_public">
                  {{ form.errors.is_public }}
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
import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";

const props = defineProps({
  blog: Object,
  
});

const form = useForm({
  title: props.blog.title,
  image: props.blog.image,
  
  detail: props.blog.detail,
 
  is_public: props.blog.is_public ? true : false,
 
});

function submitBlog() {
  form.put(`/admin/blogs/${props.blog.id}`);
}
</script>

<style>
</style>