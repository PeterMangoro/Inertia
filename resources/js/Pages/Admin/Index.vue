<template>
    <admin-layout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 sm:px-20">
                        <div class="text-xl font-bold text-green-700">
                            Zimall App
                        </div>

                        <div class="mt-8 text-2xl">
                            Zimall Database Statistics
                        </div>
                    </div>

                    <div class="mt-6">
                                <div class="flex items-center max-w-6xl py-5 pt-10 mx-auto">
                                    <div
                                        class="flex-initial w-1/3 max-w-sm p-4 m-3 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700"
                                        >
                                         <Link class="" :href="`/admin/products`">
                                        <h2 class="font-bold">Products In Database</h2>
                                        <p class="text-5xl text-orange-500"> {{ num_products }} </p>
                                        <div class="border-t border-gray-100"></div>
                                        <div class="flex">
                                            <p class="w-1/2 text-sm">Today - 2</p>
                                            <p class="w-1/2 text-sm">This Month - 3</p>
                                        </div>
                                        </Link>
                                    </div>

                                    <div
                                        class="flex-initial w-1/3 max-w-sm p-4 m-3 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700"
                                        >
                                        <Link class="" :href="`/admin/blogs`">
                                        <h2 class="font-bold">Total Blogs</h2>
                                        <p class="text-5xl text-green-500">{{ num_blogs }}</p>
                                        <div class="border-t border-gray-100"></div>
                                        <div class="flex">
                                            <p class="w-1/2 text-sm">Today - 8</p>
                                            <p class="w-1/2 text-sm">This Month - 3</p>
                                            
                                        </div>
                                        </Link>
                                    </div>


                                    <div
                                        class="flex-initial w-1/3 max-w-sm p-4 m-3 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700"
                                        >
                                        <Link class="" :href="`/admin/countries`">
                                              <h2 class="font-bold">Countries</h2>
                                        <p class="text-5xl text-purple-500">{{ num_countries }}</p>
                                        <div class="border-t border-gray-100"></div>
                                        <div class="flex">
                                            <p class="w-1/2 text-sm">Today - 8</p>
                                            <p class="w-1/2 text-sm">This Month - 3</p>
                                        </div>
                                        </Link>
                                    </div>

                                    <div
                                        class="flex-initial w-1/3 max-w-sm p-4 m-3 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700"
                                        >
                                        <Link class="" :href="`/admin/users`">
                                              <h2 class="font-bold">Users</h2>
                                        <p class="text-5xl text-purple-500">{{ num_users }}</p>
                                        <div class="border-t border-gray-100"></div>
                                        <div class="flex">
                                            <p class="w-1/2 text-sm">Today - 8</p>
                                            <p class="w-1/2 text-sm">This Month - 3</p>
                                        </div>
                                        </Link>
                                    </div>

                                </div>
                            </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import {Link} from '@inertiajs/inertia-vue3'

const props = defineProps({
    num_countries: Object,
    num_blogs: Object,
    num_users: Object,
    num_products: Object,
});
</script>

<style></style>
