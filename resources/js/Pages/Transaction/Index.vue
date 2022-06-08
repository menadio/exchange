<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/Authenticated.vue";
import { EyeIcon } from "@heroicons/vue/outline";
import { Link } from "@inertiajs/inertia-vue3";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { reactive, ref } from "vue";
import AppButton from "@/Components/Button.vue";
import AppLabel from "@/Components/Label.vue";
import AppInput from "@/Components/Input.vue";

const props = defineProps(["transactions"]);
const form = reactive({
  startDate: null,
  endDate: null,
});

let open = ref(false);

function openDownloadModal() {
  open.value = true;
}
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
                  w-1/6
                "
              >
                Name
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
                  w-1/6
                "
              >
                Currency
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
                  w-1/6
                "
              >
                Type
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
                  lg:table-cell
                  w-1/6
                "
              >
                Amount
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
                  lg:table-cell
                  w-1/6
                "
              >
                Rate
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
                  lg:table-cell
                  w-1/6
                "
              >
                Channel
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
                  lg:table-cell
                  w-1/4
                "
              ></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            <tr v-for="transaction in transactions.data" :key="transaction.id">
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
                {{ transaction.user.name }}
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
                {{ transaction.currency.code }}
              </td>
              <td
                class="hidden whitespace-nowrap px-3 py-4 text-sm sm:table-cell"
                :class="
                  transaction.trade_type.id == 1
                    ? 'text-green-600'
                    : 'text-red-500'
                "
              >
                {{ transaction.trade_type.name }}
              </td>
              <td
                class="
                  hidden
                  whitespace-nowrap
                  px-3
                  py-4
                  text-sm text-gray-500
                  sm:table-cell
                "
              >
                {{ transaction.amount }}
              </td>
              <td
                class="
                  hidden
                  whitespace-nowrap
                  px-3
                  py-4
                  text-sm text-gray-500
                  lg:table-cell
                "
              >
                {{ transaction.rate }}
              </td>
              <td
                class="
                  hidden
                  whitespace-nowrap
                  px-3
                  py-4
                  text-sm text-gray-500
                  lg:table-cell
                "
              >
                {{ transaction.channel.name }}
              </td>
              <td
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
                  :href="route('transactions.show', transaction.id)"
                  class="text-gray-300 hover:text-indigo-700"
                >
                  <EyeIcon class="h-6 w-6" />
                </Link>
              </td>
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
            <span class="font-medium">{{ transactions.from }}</span>
            {{ " " }}
            to
            <span class="font-medium">{{ transactions.to }}</span>
            {{ " " }}
            of
            <span class="font-medium">{{ transactions.total }}</span>
            {{ " " }}
            results
          </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">
          <a
            :href="transactions.first_page_url"
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
            :href="transactions.next_page_url"
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

    <!-- download modal -->
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="open = false">
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          />
        </TransitionChild>

        <div class="fixed z-10 inset-0 overflow-y-auto">
          <div
            class="
              flex
              items-end
              sm:items-center
              justify-center
              min-h-full
              p-4
              text-center
              sm:p-0
            "
          >
            <TransitionChild
              as="template"
              enter="ease-out duration-300"
              enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              enter-to="opacity-100 translate-y-0 sm:scale-100"
              leave="ease-in duration-200"
              leave-from="opacity-100 translate-y-0 sm:scale-100"
              leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
              <DialogPanel
                class="
                  relative
                  bg-white
                  rounded-lg
                  px-4
                  pt-5
                  pb-4
                  text-left
                  overflow-hidden
                  shadow-xl
                  transform
                  transition-all
                  sm:my-8 sm:max-w-lg sm:w-full sm:p-6
                "
              >
                <DialogTitle
                  as="h3"
                  class="text-lg leading-6 font-medium text-gray-900"
                >
                  Download Transactions
                </DialogTitle>

                <form>
                  <div class="mt-4">
                    <AppLabel value="Start Date" />
                    <div class="mt-1">
                      <AppInput
                        v-model="form.startDate"
                        type="date"
                        required
                        class="w-full"
                      />
                    </div>
                  </div>

                  <div class="mt-4">
                    <AppLabel value="End Date" />
                    <div class="mt-1">
                      <AppInput
                        v-model="form.endDate"
                        type="date"
                        required
                        class="w-full"
                      />
                    </div>
                  </div>

                  <div class="mt-4">
                    <a :href="route('transactions.download', form)">Download</a>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </AppLayout>
</template>