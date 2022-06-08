<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import AppLabel from "@/Components/Label.vue";
import AppInput from "@/Components/Input.vue";
import AppButton from "@/Components/Button.vue";
import { CheckCircleIcon, XCircleIcon, XIcon } from "@heroicons/vue/solid";

const props = defineProps(["rates", "currencies", "success", "message"]);
const form = reactive({
  currency: null,
  buy: null,
  sell: null,
});

let open = ref(false);
const show = ref(true);

function addRate() {
  open.value = true;
}

function submit() {
  Inertia.post(route("rates.store"), form);
  open.value = false;
  onFinishe: () => {
    console.log("reset form");
    form.reset();
  };
}
</script>

<template>
  <AppLayout>
    <!-- flash message -->
    <div class="px-4 sm:px-6 lg:px-8">
      <!-- success message -->
      <div
        v-if="$page.props.flash.success && show"
        class="mt-8 rounded-md bg-green-50 p-4"
      >
        <div class="flex">
          <div class="flex-shrink-0">
            <CheckCircleIcon
              class="h-5 w-5 text-green-400"
              aria-hidden="true"
            />
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-green-800">
              Successfully uploaded
            </p>
          </div>
          <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
              <button
                @click="show = false"
                type="button"
                class="
                  inline-flex
                  bg-green-50
                  rounded-md
                  p-1.5
                  text-green-500
                  hover:bg-green-100
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-offset-green-50
                  focus:ring-green-600
                "
              >
                <span class="sr-only">Dismiss</span>
                <XIcon class="h-5 w-5" aria-hidden="true" />
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- error message -->
      <div
        v-if="
          $page.props.flash.error ||
          (Object.keys($page.props.errors).length > 0 && show)
        "
        class="mt-8 rounded-md bg-red-50 p-4"
      >
        <div class="flex">
          <div class="flex-shrink-0">
            <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">
              There were 2 errors with your submission
            </h3>
            <div class="mt-2 text-sm text-red-700">
              <ul role="list" class="list-disc pl-5 space-y-1">
                <li>Your password must be at least 8 characters</li>
                <li>
                  Your password must include at least one pro wrestling
                  finishing move
                </li>
              </ul>
            </div>
          </div>
          <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
              <button
                @click="show = false"
                type="button"
                class="
                  inline-flex
                  bg-green-50
                  rounded-md
                  p-1.5
                  text-green-500
                  hover:bg-green-100
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-offset-green-50
                  focus:ring-green-600
                "
              >
                <span class="sr-only">Dismiss</span>
                <XIcon class="h-5 w-5" aria-hidden="true" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- exchange rate history -->
    <div class="mt-8 px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">History</h1>
          <p class="mt-2 text-sm text-gray-700">Exchange rate history.</p>
        </div>

        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
          <button
            @click="addRate"
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
            New Rate
          </button>
        </div>
      </div>

      <!-- list -->
      <div
        class="
          -mx-4
          mt-8
          overflow-hidden
          shadow
          ring-1 ring-black ring-opacity-5
          sm:-mx-6
          md:mx-0 md:rounded-lg
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
                  w-1/5
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
                  w-1/5
                "
              >
                Buy
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
                  w-1/5
                "
              >
                Sell
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
                  w-1/5
                "
              >
                Added On
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
                  w-1/5
                "
              >
                Updated At
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            <tr v-for="rate in rates.data" :key="rate.id">
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
                  capitalize
                "
              >
                {{ rate.currency.code }}
              </td>
              <td
                class="
                  hidden
                  whitespace-nowrap
                  px-3
                  py-4
                  text-sm text-gray-500
                  sm:table-cell
                  uppercase
                "
              >
                {{ rate.buy }}
              </td>
              <td
                class="
                  hidden
                  whitespace-nowrap
                  px-3
                  py-4
                  text-sm text-gray-500
                  sm:table-cell
                  uppercase
                "
              >
                {{ rate.sell }}
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
                {{ rate.created_at }}
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
                {{ rate.updated_at }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- pagination buttons -->
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
            <span class="font-medium">{{ rates.from }}</span>
            {{ " " }}
            to
            <span class="font-medium">{{ rates.to }}</span>
            {{ " " }}
            of
            <span class="font-medium">{{ rates.total }}</span>
            {{ " " }}
            results
          </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">
          <a
            :href="rates.first_page_url"
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
            :href="rates.next_page_url"
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

    <!-- add user modal -->
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
                  New Exchange Rate
                </DialogTitle>

                <form @submit.prevent="submit">
                  <div class="mt-1 relative">
                    <AppLabel value="Currency" />
                    <select
                      id="currency"
                      v-model="form.currency"
                      class="
                        mt-1
                        block
                        w-full
                        pl-3
                        pr-10
                        py-2
                        text-base
                        border-gray-300
                        focus:outline-none
                        focus:ring-indigo-500
                        focus:border-indigo-500
                        sm:text-sm
                        rounded-md
                      "
                    >
                      <option
                        v-for="currency in currencies"
                        :key="currency.id"
                        :value="currency.id"
                      >
                        {{ currency.code }}
                      </option>
                    </select>
                  </div>

                  <div class="mt-4">
                    <AppLabel value="Buy" />
                    <div class="mt-1">
                      <AppInput
                        v-model="form.buy"
                        type="number"
                        required
                        class="w-full"
                      />
                    </div>
                  </div>

                  <div class="mt-4">
                    <AppLabel value="Sell" />
                    <div class="mt-1">
                      <AppInput
                        v-model="form.sell"
                        type="number"
                        required
                        class="w-full"
                      />
                    </div>
                  </div>

                  <div class="mt-4">
                    <AppButton>Save</AppButton>
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