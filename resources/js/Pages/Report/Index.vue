<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/Authenticated.vue";

const props = defineProps(["reports"]);
</script>

<template>
  <AppLayout>
    <!-- main content -->
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">All Transactions</h1>
          <p class="mt-2 text-sm text-gray-700">
            List of all trade transactions record.
          </p>
        </div>

        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
          <button
            @click="openDownloadModal"
            type="button"
            class="
              inline-flex
              items-center
              justify-center
              rounded-md
              border border-transparent
              bg-indigo-600
              px-4
              py-2
              text-sm
              font-medium
              text-white
              shadow-sm
              hover:bg-indigo-700
              focus:outline-none
              focus:ring-2
              focus:ring-indigo-500
              focus:ring-offset-2
              sm:w-auto
            "
          >
            Download
          </button>
        </div>
      </div>

      <section
        class="
          w-full
          mt-8
          -mx-4
          overflow-hidden
          shadow
          ring-1 ring-black ring-opacity-5
          sm:-mx-6
          md:mx-0 md:rounded-lg
          bg-white
        "
      >
        <table class="min-w-full divide-y divide-gray-300 table-fixed">
          <thead class="bg-gray-50">
            <tr>
              <th
                scope="col"
                class="
                  py-3.5
                  pl-4
                  pr-3
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:pl-6
                "
              >
                Period
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                USD Purchased
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                USD Sold
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                GBP Purchased
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                GBP Sold
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                EUR Purchased
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                EUR Sold
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                AED Purchased
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                AED Sold
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                NGN Purchase
              </th>
              <th
                scope="col"
                class="
                  hidden
                  px-3
                  py-3.5
                  text-left text-sm
                  font-semibold
                  text-gray-900
                  sm:table-cell
                "
              >
                NGN Sold
              </th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200 bg-white">
            <tr v-for="report in reports.data" :key="report.id">
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.period }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_usd_purchased }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_usd_sold }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_gbp_purchased }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_gbp_sold }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_eur_purchased }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_eur_sold }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_aed_purchased }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_aed_sold }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_naira_purchase_value }}
              </td>
              <td
                class="
                  whitespace-nowrap
                  py-4
                  pl-4
                  pr-3
                  text-sm
                  font-medium
                  text-gray-900
                  sm:pl-6
                "
              >
                {{ report.total_naira_sold_value }}
              </td>
              <!-- <td
                class="
                  hidden
                  whitespace-nowrap
                  px-3
                  py-4
                  text-sm text-gray-500
                  lg:table-cell
                "
              >
                <Link
                  href="route('transactions.show', transaction.id)"
                  class="text-gray-300 hover:text-indigo-700"
                >
                  <EyeIcon class="h-6 w-6" />
                </Link>
              </td> -->
            </tr>
          </tbody>
        </table>
      </section>

      <nav
        class="
          bg-white
          mt-4
          px-4
          py-3
          flex
          items-center
          justify-between
          border-t border-gray-200
          sm:px-6
          rounded-lg
        "
        aria-label="Pagination"
      >
        <div class="hidden sm:block">
          <p class="text-sm text-gray-700">
            Showing
            <span class="font-medium">{{ reports.from }}</span>
            {{ " " }}
            to
            <span class="font-medium">{{ reports.to }}</span>
            {{ " " }}
            of
            <span class="font-medium">{{ reports.total }}</span>
            {{ " " }}
            results
          </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">
          <a
            :href="reports.first_page_url"
            class="
              relative
              inline-flex
              items-center
              px-4
              py-2
              border border-gray-300
              text-sm
              font-medium
              rounded-md
              text-gray-700
              bg-white
              hover:bg-gray-50
            "
          >
            Previous
          </a>
          <a
            :href="reports.next_page_url"
            class="
              ml-3
              relative
              inline-flex
              items-center
              px-4
              py-2
              border border-gray-300
              text-sm
              font-medium
              rounded-md
              text-gray-700
              bg-white
              hover:bg-gray-50
            "
          >
            Next
          </a>
        </div>
      </nav>
    </div>
  </AppLayout>
</template>