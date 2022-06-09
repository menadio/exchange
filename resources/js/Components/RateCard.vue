<script setup>
defineProps(["rate"]);

</script>

<template>
  <div
    class="px-4 py-4 col-lg-3 col-md-6 col-sm-6 bg-white rounded-lg shadow-lg"
  >
    <div class="w-full flex items-center justify-between px-6 py-2 space-x-6">
      <div class="flex-1 truncate">
        <div class="flex items-center space-x-3">
          <h3 class="text-gray-900 text-sm font-medium truncate">{{ rate.currency.code }}</h3>
        </div>
      </div>
    </div>

    <div>
      <div class="-mt-px flex divide-x divide-gray-200 text-center">
        <div class="w-0 flex-1 flex flex-col divide-y divide-gray-200">
          <div class="mb-4 text-4xl font-thin">
            <h4>{{ rate.buy }}</h4>
          </div>
          <div class="text-sm font-bold text-gray-500 uppercase">
            <p>buy</p>
          </div>
        </div>
        
        <div class="w-0 flex-1 flex flex-col divide-y divide-gray-200">
          <div class="mb-4 text-4xl font-thin">
            <h4>{{ rate.sell }}</h4>
          </div>
          <div class="text-sm font-bold text-gray-500 uppercase">
            <p>sell</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>