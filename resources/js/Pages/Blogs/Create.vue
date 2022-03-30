<template>
  <admin-layout title="Dashboard">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Blogs Create
      </h2>
    </template>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex w-full p-2 mb-4">
        <Link
          :href="route('admin.blogs.index')"
          class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-800"
        >
          Blog Index
        </Link>
      </div>
      <section class="flex content-center">
        <form @submit.prevent="storeBlog">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="w-full space-y-3">
                <div class="">
                  <label
                    for="title"
                    class="block text-sm font-medium text-gray-700"
                    >Blog title</label
                  >
                  <input
                    v-model="form.blogTitle"
                    type="text"
                    autocomplete="title"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  />
                </div>
                <div class="">
                  <label
                    for="title"
                    class="block text-sm font-medium text-gray-700"
                    >Blog Author</label
                  >
                  <input
                    v-model="form.blogAuthor"
                    type="text"
                    autocomplete="author"
                   
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  />
                </div>

                 <div class="">
                  <label
                    for="detail"
                    class="block text-sm font-medium text-gray-700"
                    >Blog detail</label
                  >
                  <textarea
                    v-model="form.blogDetail"
                    type="text"
                    autocomplete="detail"
                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  ></textarea>
                </div>

                <div>
                  <button
                    type="submit"
                    class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-700"
                  >
                    Create
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
    </div>
  </admin-layout>
</template>

<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    user:Object
})

const form = useForm({
  blogTitle: "",
  blogDetail:"",
  blogAuthor:props.user.name
});

function storeBlog() {
  form.post("/admin/blogs");
}
</script>

<style>
</style>