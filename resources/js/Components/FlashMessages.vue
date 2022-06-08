<script setup>
import { CheckCircleIcon, XIcon, XCircleIcon } from '@heroicons/vue/solid'
// import { watch } from 'vue';

let show = true;

watch = () => {
    $page.props.flash = {
        handler() {
            this.show = true;
        },
        deep: true,
    }
}
</script>

<template>
  <div>
    <!-- success message -->
    <div v-if="$page.props.flash.success && show" class="rounded-md bg-green-50 p-4">
      <div class="flex">
        <div class="flex-shrink-0">
          <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true" />
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium text-green-800">Successfully uploaded</p>
        </div>
        <div class="ml-auto pl-3">
          <div class="-mx-1.5 -my-1.5">
            <button @click="show = false" type="button" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
              <span class="sr-only">Dismiss</span>
              <XIcon class="h-5 w-5" aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- error message -->
    <div v-if="$page.props.flash.error || Object.keys($page.props.errors).length > 0 && show" class="rounded-md bg-red-50 p-4">
      <div class="flex">
        <div class="flex-shrink-0">
          <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">There were 2 errors with your submission</h3>
          <div class="mt-2 text-sm text-red-700">
            <ul role="list" class="list-disc pl-5 space-y-1">
              <li>Your password must be at least 8 characters</li>
              <li>Your password must include at least one pro wrestling finishing move</li>
            </ul>
          </div>
        </div>
        <div class="ml-auto pl-3">
          <div class="-mx-1.5 -my-1.5">
            <button @click="show = false" type="button" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
              <span class="sr-only">Dismiss</span>
              <XIcon class="h-5 w-5" aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

