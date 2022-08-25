<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BalanceCard from "@/Components/BalanceCard.vue";
import RateCard from "@/Components/RateCard.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import {CurrencyDollarIcon} from "@heroicons/vue/outline";
import {reactive, ref} from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {TrashIcon} from "@heroicons/vue/outline";
import {
    ExclamationIcon,
    XCircleIcon,
    XIcon,
    CheckCircleIcon,
} from "@heroicons/vue/outline";
import AppLabel from "@/Components/Label.vue";
import AppInput from "@/Components/Input.vue";
import AppButton from "@/Components/Button.vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps([
    "rates",
    "transactions",
    "currencies",
    "types",
    "channels",
    "balances",
]);
const form = reactive({
    currency: null,
    type: null,
    amount: null,
    channel: null,
    exchangeChannel: null,
    note: null,
    specialRate: null,
});
const open = ref(false);
const show = ref(true);

function trade() {
    open.value = true;
}

function submit() {
    Inertia.post(route("transactions.store"), form);
    open.value = false;
}

const runEndOfDayReport = () => {
    Inertia.get(route('trade.close'));
}
</script>

<template>
    <BreezeAuthenticatedLayout>
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
                                class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600"
                            >
                                <span class="sr-only">Dismiss</span>
                                <XIcon class="h-5 w-5" aria-hidden="true"/>
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
                        <XCircleIcon
                            class="h-5 w-5 text-red-400"
                            aria-hidden="true"
                        />
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            There were 2 errors with your submission
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul role="list" class="list-disc pl-5 space-y-1">
                                <li>
                                    Your password must be at least 8 characters
                                </li>
                                <li>
                                    Your password must include at least one pro
                                    wrestling finishing move
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button
                                @click="show = false"
                                type="button"
                                class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600"
                            >
                                <span class="sr-only">Dismiss</span>
                                <XIcon class="h-5 w-5" aria-hidden="true"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- dashboard content -->
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">
                        Current Exchange Rate
                    </h1>
                </div>
            </div>

            <!-- exchange rates -->
            <div v-if="rates.length > 0" class="mt-6 grid grid-cols-4 gap-6">
                <RateCard v-for="rate in rates" :key="rate.id" :rate="rate"/>
            </div>

            <div v-else class="px-6 py-8 bg-white text-center shadow rounded-lg">
                You will not be able to start trading until exchange rates are set. Click
                <Link :href="route('rates.index')" class="underline">here</Link>
                to set rates.
            </div>

            <div class="mt-12 sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">
                        Trade Opening Balance
                    </h1>
                </div>
            </div>

            <!-- trade opening balances -->
            <div v-if="balances.length > 0" class="mt-6 grid grid-cols-5 gap-2">
                <BalanceCard
                    v-for="balance in balances"
                    :key="balance.id"
                    :balance="balance"
                />
            </div>

            <div v-else class="px-6 py-8 bg-white text-center shadow rounded-lg">
                You will not be able to start trading until trading balances are set. Click
                <Link :href="route('trade-balances.index')" class="underline">here</Link>
                to set trade balances.
            </div>

            <!-- daily trade transactions -->
            <div class="mt-16 sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">
                        Today's Trade
                    </h1>
                </div>

                <div v-if="rates.length > 0 && balances.length > 0 " class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none grid grid-cols-2 gap-x-5">
                    <button
                        @click="runEndOfDayReport"
                        type="button"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >
                        Close Trade
                    </button>
                    <button
                        @click="trade"
                        type="button"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >
                        Buy / Sell
                    </button>
                </div>
            </div>

            <div class="mt-8 flex gap-6">
                <!-- daily transactions -->
                <section
                    class="w-full -mx-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg bg-white"
                >
                    <table
                        class="min-w-full divide-y divide-gray-300 table-fixed"
                    >
                        <thead class="bg-gray-50">
                        <tr>
                            <th
                                scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell w-1/6"
                            >
                                Currency
                            </th>
                            <th
                                scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell w-1/6"
                            >
                                Type
                            </th>
                            <th
                                scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell w-1/6"
                            >
                                Amount
                            </th>
                            <th
                                scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell w-1/6"
                            >
                                Rate
                            </th>
                            <th
                                scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell w-1/6"
                            >
                                Channel
                            </th>
                            <th
                                scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell w-1/6"
                            >
                                Naira
                            </th>
                            <th
                                scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell w-1/6"
                            >
                                Traded At
                            </th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                        <tr
                            v-for="transaction in transactions"
                            :key="transaction.id"
                        >
                            <td
                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
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
                                class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell"
                            >
                                {{
                                    new Intl.NumberFormat().format(
                                        transaction.amount
                                    )
                                }}
                            </td>
                            <td
                                class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell"
                            >
                                {{ transaction.rate }}
                            </td>
                            <td
                                class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell"
                            >
                                {{ transaction.channel.name }}
                            </td>
                            <td
                                class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell"
                            >
                                {{ transaction.value }}
                            </td>
                            <td
                                class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell"
                            >
                                {{ transaction.created_at }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>

        <!-- trade modal -->
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
                                    Trade
                                </DialogTitle>

                                <form @submit.prevent="submit">
                                    <div class="mt-4 relative">
                                        <AppLabel value="Currency"/>
                                        <select
                                            id="currency"
                                            v-model="form.currency"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
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

                                    <div class="mt-4 relative">
                                        <AppLabel value="Buy / Sell"/>
                                        <select
                                            id="type"
                                            v-model="form.type"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                        >
                                            <option
                                                v-for="type in types"
                                                :key="type.id"
                                                :value="type.id"
                                            >
                                                {{ type.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mt-4">
                                        <AppLabel value="Amount"/>
                                        <div class="mt-1">
                                            <AppInput
                                                v-model="form.amount"
                                                type="number"
                                                min="1"
                                                required
                                                class="w-full"
                                            />
                                        </div>
                                    </div>

                                    <div class="mt-4 relative">
                                        <AppLabel value="Channel"/>
                                        <select
                                            id="type"
                                            v-model="form.channel"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                        >
                                            <option
                                                v-for="channel in channels"
                                                :key="channel.id"
                                                :value="channel.id"
                                            >
                                                {{ channel.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <hr/>

                                    <DialogTitle
                                        as="h3"
                                        class="mt-8 text-lg leading-6 font-medium text-gray-900"
                                    >
                                        Exchange
                                    </DialogTitle>

                                    <div class="mt-4 relative">
                                        <AppLabel value="Exchange Channel"/>
                                        <select
                                            id="type"
                                            v-model="form.exchangeChannel"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                        >
                                            <option
                                                v-for="channel in channels"
                                                :key="channel.id"
                                                :value="channel.id"
                                            >
                                                {{ channel.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mt-4 relative">
                                        <AppLabel value="Note"/>
                                        <textarea
                                            v-model="form.note"
                                            id="note"
                                            name="note"
                                            rows="3"
                                            class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"
                                        />
                                        <!-- <select
                      id="type"

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
                        v-for="channel in channels"
                        :key="channel.id"
                        :value="channel.id"
                      >
                        {{ channel.name }}
                      </option>
                    </select> -->
                                    </div>

                                    <div class="mt-4">
                                        <AppLabel value="Special Rate"/>
                                        <div class="mt-1">
                                            <AppInput
                                                v-model="form.specialRate"
                                                type="number"
                                                min="1"
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
    </BreezeAuthenticatedLayout>
</template>
