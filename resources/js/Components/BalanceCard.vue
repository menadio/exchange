<script setup>
const { computed } = require("@vue/runtime-core");

defineProps(["balance"]);

const openingBal = computed(() => {
    return balance.opening_balance.toLocalString("en-US");
});
</script>

<template>
    <div
        class="px-4 py-4 col-lg-3 col-md-6 col-sm-6 bg-white rounded-lg shadow-lg"
    >
        <div class="w-full flex items-center justify-between py-2 space-x-6">
            <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                    <h3 class="text-gray-900 text-sm font-medium truncate">
                        {{ balance.currency.code }} Balance
                    </h3>
                </div>
            </div>
        </div>

        <div>
            <div class="-mt-px flex divide-x divide-gray-200">
                <div class="w-0 flex-1 flex flex-col divide-y divide-gray-200">
                    <div class="mb-4 text-lg font-medium">
                        <h4>{{ balance.opening_balance }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
