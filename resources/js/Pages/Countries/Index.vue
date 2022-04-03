<template>
  <admin-layout name="Dashboard">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Countries Index
      </h2>
    </template>

    <div class="py-2">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <section class="container p-6 mx-auto font-mono">
          <div class="flex justify-end w-full p-2 mb-4">
            <Link
              :href="route('admin.countries.create')"
              class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-800"
            >
              Create Country 
            </Link>
          </div>

          <div
            class="w-full mb-8 overflow-hidden bg-white rounded-lg shadow-lg"
          >
            <div class="p-2 m-2">
              <div class="flex justify-between">
                <div class="flex-1">
                  <div class="relative">
                    <div class="absolute flex items-center h-full ml-2">
                      <svg
                        class="w-4 h-4 fill-current text-primary-gray-dark"
                        viewBox="0 0 16 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M15.8898 15.0493L11.8588 11.0182C11.7869 10.9463 11.6932 10.9088 11.5932 10.9088H11.2713C12.3431 9.74952 12.9994 8.20272 12.9994 6.49968C12.9994 2.90923 10.0901 0 6.49968 0C2.90923 0 0 2.90923 0 6.49968C0 10.0901 2.90923 12.9994 6.49968 12.9994C8.20272 12.9994 9.74952 12.3431 10.9088 11.2744V11.5932C10.9088 11.6932 10.9495 11.7869 11.0182 11.8588L15.0493 15.8898C15.1961 16.0367 15.4336 16.0367 15.5805 15.8898L15.8898 15.5805C16.0367 15.4336 16.0367 15.1961 15.8898 15.0493ZM6.49968 11.9994C3.45921 11.9994 0.999951 9.54016 0.999951 6.49968C0.999951 3.45921 3.45921 0.999951 6.49968 0.999951C9.54016 0.999951 11.9994 3.45921 11.9994 6.49968C11.9994 9.54016 9.54016 11.9994 6.49968 11.9994Z"
                        ></path>
                      </svg>
                    </div>

                    <input
                      v-model="countryFilters.search"
                      type="text"
                      placeholder="Search by name"
                      class="w-full px-8 py-3 text-sm bg-gray-100 border-transparent rounded-md md:w-2/6 focus:border-gray-500 focus:bg-white focus:ring-0"
                    />
                  </div>
                </div>
                <div class="flex">
                  <select
                   v-model="countryFilters.perPage"
                   @change="countryFilters.perPage === $event.target.value"
                    class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0"
                  >
                    <option value="5">5 Per Page</option>
                    <option value="10">10 Per Page</option>
                    <option value="15">15 Per Page</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="w-full overflow-x-auto">
              <table class="w-full">
                <thead>
                  <tr
                    class="font-semibold tracking-wide text-left text-gray-900 uppercase bg-gray-100 border-b border-gray-600 text-md"
                  >
                    <th class="px-4 py-3 cursor-pointer" @click="sort('id')">
                      <div class="flex content-center space-x-4">
                      <span>ID</span>
                      <svg
                        v-if="
                          countryFilters.column == 'id' &&
                          countryFilters.direction == 'desc'
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-indigo-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 13l-5 5m0 0l-5-5m5 5V6"
                        />
                      </svg>
                      <svg
                        v-if="
                          countryFilters.column == 'id' &&
                          countryFilters.direction == 'asc'
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-indigo-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M7 11l5-5m0 0l5 5m-5-5v12"
                        />
                      </svg>
                      </div>
                    </th>
                    
                    <th class="px-4 py-3 cursor-pointer"  @click="sort('name')">
                      <div class="flex content-center space-x-4">
                      <span>Name</span>
                      <svg
                        v-if="
                          countryFilters.column == 'name' &&
                          countryFilters.direction == 'desc'
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-indigo-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 13l-5 5m0 0l-5-5m5 5V6"
                        />
                      </svg>
                      <svg
                        v-if="
                          countryFilters.column == 'name' &&
                          countryFilters.direction == 'asc'
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-indigo-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M7 11l5-5m0 0l5 5m-5-5v12"
                        />
                      </svg>
                      </div>
                    
                      </th>
                     <th class="px-4 py-3 cursor-pointer" @click="sort('capital')"> 
                       <div class="flex content-center space-x-4">
                       <span>Capital</span>
                       <svg
                        v-if="
                          countryFilters.column == 'capital' &&
                          countryFilters.direction == 'desc'
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-indigo-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 13l-5 5m0 0l-5-5m5 5V6"
                        />
                      </svg>
                      <svg
                        v-if="
                          countryFilters.column == 'capital' &&
                          countryFilters.direction == 'asc'
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-indigo-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M7 11l5-5m0 0l5 5m-5-5v12"
                        />
                      </svg>
                       </div>
                       </th>
                    
                     <th class="px-4 py-3 ">iso3</th>
                     <th class="px-4 py-3 ">Code</th>
                    <th class="px-4 py-3 ">Manage</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr
                    v-for="country in countries.data"
                    :key="country.id"
                    class="text-gray-700"
                  >
                    <td class="px-4 py-3 border">{{ country.id }}</td>
                   
                    <td class="px-4 py-3 font-semibold border text-ms">
                      {{ country.name }}
                    </td>

                     <td class="px-4 py-3 font-semibold border text-ms">
                      {{ country.capital }}
                    </td>

                     <td class="px-4 py-3 border">{{ country.iso3 }}
                    </td>

                      <td class="px-4 py-3 border">{{ country.phonecode }}</td>

                    <td class="px-4 py-3 text-sm border">
                      <div class="flex justify-around">
                        
                        <Link
                          :href="route('admin.countries.destroy', country.id)"
                          method="delete"
                          as="button"
                          type="button"
                          class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700"
                        >
                          Delete
                        </Link>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="p-2 m-2">
<Pagination :links="countries.links" />
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </admin-layout>
</template>

<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "../../Components/Pagination.vue"
import { ref, watch, defineProps,reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { throttle, pickBy } from "lodash";


const props = defineProps({
  countries: Object,
  filters: Object,
});


const countryFilters = reactive({
  search: props.filters.search,
  perPage: props.filters.perPage,
  column: props.filters.column,
  direction: props.filters.direction,
});


watch(
  countryFilters,
  throttle(() => {
    let query = pickBy(countryFilters);
    let queryRoute = route(
      "admin.countries.index",
      Object.keys(query).length
        ? query
        : {
            remember: "forget",
          }
    );
    Inertia.get(
      queryRoute,
      {},
      {
        preserveState: true,
        replace: true,
      }
    );
  }, 400),
  {
    deep: true,
  }
);


function sort(column) {
  countryFilters.column = column;
  countryFilters.direction = countryFilters.direction === "asc" ? "desc" : "asc";
}

</script>
<style>

</style>