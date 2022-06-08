<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/Authenticated.vue";
import { ArrowNarrowLeftIcon } from "@heroicons/vue/outline";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["transaction"]);
</script>

<template>
  <AppLayout>
    <!-- main content -->
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <Link :href="route('transactions.index')">
                <span><ArrowNarrowLeftIcon class="h-6 w-6"/></span> 
            </Link>
        </div>
      </div>

      <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Transaction Details</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Specific details of the transaction.</p>
        </div>
        <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Full name</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ transaction.user.name }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Type of Trade</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ transaction.trade_type.name }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Currency</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ transaction.currency.code }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Amount</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ transaction.amount }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Exchange Rate</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ transaction.rate }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Traded At</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ transaction.created_at }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Trade Updated At</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ transaction.updated_at }}</dd>
            </div>
        </dl>
        </div>
    </div>
    </div>
  </AppLayout>
</template>