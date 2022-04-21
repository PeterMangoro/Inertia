<template>
  <admin-layout title="Dashboard">
    <template #header> Provinces or States </template>

    <div class="py-2">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <section class="container p-6 mx-auto font-mono">
          <div class="flex w-full p-2 mb-4">
            <Link              
              class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-800"
              :href="route('admin.states.create', country.id)"
            >
              Add Province 
            </Link>

            <Link
              :href="route('admin.countries.index')"
              class="justify-end px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-700"
            >
              Go Back to Country Index
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
                      v-model="search"
                      type="text"
                      placeholder="Search by title"
                      class="w-full px-8 py-3 text-sm bg-gray-100 border-transparent rounded-md md:w-2/6 focus:border-gray-500 focus:bg-white focus:ring-0"
                    />
                  </div>
                </div>
                <div class="flex">
                  <select
                    v-model="perPage"
                    @change="getStates"
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
              <Table>
                <template #tableHead>
                  <TableHead>Name</TableHead>
                  <TableHead>Country code</TableHead>
                  
                  <TableHead>Manage</TableHead>
                </template>
                <TableRow v-for="state in states.data" :key="state.id">
                  <TableData>{{ state.name }}</TableData>
                  <TableData>{{ state.country_code }}</TableData>
                 
                  <TableData>
                    <div class="flex justify-around">
                      <ButtonLink
                        class="bg-blue-500 hover:bg-blue-700"
                       :link="
                          route('admin.cities.index', [country.id, state.id])
                        "
                        
                        >Cities</ButtonLink
                      >
                      <ButtonLink
                        :link="
                          route('admin.states.edit', [country.id, state.id])
                        "
                        >Edit</ButtonLink
                      >
                      <ButtonLink
                        class="bg-red-500 hover:bg-red-700"
                        :link="
                          route('admin.states.destroy', [country.id, state.id])
                        "
                        method="delete"
                        as="button"
                        type="button"
                        >Delete</ButtonLink
                      >
                    </div>
                  </TableData>
                </TableRow>
              </Table>
              <div class="p-2 m-2">
                <Pagination :links="states.links" />
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </admin-layout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Table from "@/Components/Table";
import TableData from "@/Components/TableData";
import TableHead from "@/Components/TableHead";
import TableRow from "@/Components/TableRow";
import ButtonLink from "@/Components/ButtonLink";

const props = defineProps({
  country: Object,
  states: Object,
  filters: Object,
});

const search = ref(props.filters.search);
const perPage = ref(props.filters.perPage);
const stateNumber = ref("");

watch(search, (value) => {
  Inertia.get(
    `/admin/countries/${props.country.id}/states`,
    { search: value, perPage: perPage.value },
    {
      preserveState: true,
      replace: true,
    }
  );
});

function getStates() {
  Inertia.get(
    `/admin/countries/${props.country.id}/states`,
    { perPage: perPage.value, search: search.value },
    {
      preserveState: true,
      replace: true,
    }
  );
}

</script>