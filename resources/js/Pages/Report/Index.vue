<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/Authenticated.vue";
import { DocumentDownloadIcon } from "@heroicons/vue/outline";
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

const props = defineProps(["reports"]);
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
                    <h1 class="text-xl font-semibold text-gray-900">Reports</h1>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button>
                        <DocumentDownloadIcon
                            @click="openDownloadModal"
                            class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300 hover:text-indigo-700"
                        />
                    </button>
                </div>
            </div>

            <section
                class="w-full mt-8 -mx-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg bg-white"
            >
                <table class="min-w-full divide-y divide-gray-300 table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                            >
                                Date
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                USD Pur
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                USD Sold
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                USD Bal
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                GBP Pur
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                GBP Sold
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                GBP Bal
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                EUR Pur
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                EUR Sold
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                EUR Bal
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                AED Pur
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                AED Sold
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                AED Bal
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                NGN Pur
                            </th>
                            <th
                                scope="col"
                                class="py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                NGN Sold
                            </th>
                            <th
                                scope="col"
                                class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                            >
                                NGN Bal
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-for="report in reports.data" :key="report.id">
                            <td
                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.date }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.usd_purchased }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.usd_sold }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.usd_bal ?? 0 }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.gbp_purchased }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.gbp_sold }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.gbp_bal ?? 0 }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.eur_purchased }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.eur_sold }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.eur_bal ?? 0 }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.aed_purchased }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.aed_sold }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.aed_bal ?? 0 }}
                            </td>
                            <td
                                class="whitespace-nowrap py-4 pl-2 pr-3 text-sm font-medium text-gray-900"
                            >
                                {{ report.naira_purchase_value }}
                            </td>
                            <td
                                class="whitespace-nowrap py-2 text-sm font-medium text-gray-900"
                            >
                                {{ report.naira_sold_value }}
                            </td>
                            <td
                                class="whitespace-nowrap py-2 text-sm font-medium text-gray-900"
                            >
                                {{ report.naira_bal ?? 0 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <nav
                class="bg-white mt-4 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-lg"
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
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Previous
                    </a>
                    <a
                        :href="reports.next_page_url"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
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
                        class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0"
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
                                class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:p-6"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Download Report
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

                                    <div
                                        v-if="
                                            form.startDate !== null &&
                                            form.endDate !== null
                                        "
                                        class="mt-4"
                                    >
                                        <a
                                            :href="
                                                route('reports.summary', form)
                                            "
                                            >Download</a
                                        >
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
