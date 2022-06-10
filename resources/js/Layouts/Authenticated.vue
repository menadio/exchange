<script setup>
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import {
  LogoutIcon,
  CalendarIcon,
  DocumentTextIcon,
  CashIcon,
  ChartBarIcon,
  FolderIcon,
  HomeIcon,
  InboxIcon,
  MenuAlt2Icon,
  UsersIcon,
  XIcon,
  MenuIcon
} from "@heroicons/vue/outline";
import { SearchIcon } from "@heroicons/vue/solid";
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import AppFlashMessages from '@/Components/FlashMessages.vue';
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const sidebarOpen = ref(false);
const showingNavigationDropdown = ref(false);

function logout() {
  Inertia.post(route('logout'));
}
</script>

<template>
  <div>
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog
        as="div"
        class="relative z-40 md:hidden"
        @close="sidebarOpen = false"
      >
        <TransitionChild
          as="template"
          enter="transition-opacity ease-linear duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="transition-opacity ease-linear duration-300"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>

        <div class="fixed inset-0 flex z-40">
          <TransitionChild
            as="template"
            enter="transition ease-in-out duration-300 transform"
            enter-from="-translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-300 transform"
            leave-from="translate-x-0"
            leave-to="-translate-x-full"
          >
            <DialogPanel
              class="
                relative
                flex-1 flex flex-col
                max-w-xs
                w-full
                pt-5
                pb-4
                bg-indigo-700
              "
            >
              <TransitionChild
                as="template"
                enter="ease-in-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
              >
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                  <button
                    type="button"
                    class="
                      ml-1
                      flex
                      items-center
                      justify-center
                      h-10
                      w-10
                      rounded-full
                      focus:outline-none
                      focus:ring-2
                      focus:ring-inset
                      focus:ring-white
                    "
                    @click="sidebarOpen = false"
                  >
                    <span class="sr-only">Close sidebar</span>
                    <XIcon class="h-6 w-6 text-white" aria-hidden="true" />
                  </button>
                </div>
              </TransitionChild>

              <div class="flex-shrink-0 flex items-center px-4">
                <img
                  class="h-8 w-auto"
                  src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg"
                  alt="Workflow"
                />
              </div>

              <div class="mt-5 flex-1 h-0 overflow-y-auto">
                <nav class="px-2 space-y-1">
                  <a
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    :class="[
                      item.current
                        ? 'bg-indigo-800 text-white'
                        : 'text-indigo-100 hover:bg-indigo-600',
                      'group flex items-center px-2 py-2 text-base font-medium rounded-md',
                    ]"
                  >
                    <component
                      :is="item.icon"
                      class="mr-4 flex-shrink-0 h-6 w-6 text-indigo-300"
                      aria-hidden="true"
                    />
                    {{ item.name }}
                  </a>
                </nav>
              </div>
            </DialogPanel>
          </TransitionChild>
          <div class="flex-shrink-0 w-14" aria-hidden="true">
            <!-- Dummy element to force sidebar to shrink to fit close icon -->
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex flex-col flex-grow pt-5 bg-abu-black overflow-y-auto">
        
        <!-- logo -->
        <div class="flex items-center flex-shrink-0 px-4">
          <img
            class="h-8 w-auto"
            src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg"
            alt="Workflow"
          />
        </div>
        
        <!-- nav menu -->
        <div class="mt-5 flex-1 flex flex-col">
          <nav class="flex-1 px-2 pb-4 space-y-1">
            <ul>
              <li class="mb-2">
                <BreezeNavLink
                  :href="route('dashboard')"
                  class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                  aria-hidden="true"
                >
                  <HomeIcon class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" /> Dashboard
                </BreezeNavLink>
              </li>
              
              <li class="mb-2">
                <BreezeNavLink
                  :href="route('transactions.index')"
                  class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                  aria-hidden="true"
                >
                  <MenuIcon class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" /> Transactions
                </BreezeNavLink>
              </li>

              <li class="mb-2">
                <BreezeNavLink
                  :href="route('reports.index')"
                  class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                  aria-hidden="true"
                >
                  <DocumentTextIcon class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" /> Reports
                </BreezeNavLink>
              </li>

              <li class="mb-2">
                <BreezeNavLink
                  :href="route('users.index')"
                  class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                  aria-hidden="true"
                >
                  <UsersIcon class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" /> Users
                </BreezeNavLink>
              </li>

              <li class="mb-2">
                <BreezeNavLink
                  :href="route('currencies.index')"
                  class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                  aria-hidden="true"
                >
                  <CashIcon class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" /> Currencies
                </BreezeNavLink>
              </li>

              <li class="mb-2">
                <BreezeNavLink
                  :href="route('rates.index')"
                  class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                  aria-hidden="true"
                >
                  <ChartBarIcon class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" /> Exchange Rates
                </BreezeNavLink>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- top menu bar -->
    <div class="md:pl-64 flex flex-col flex-1">
      <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
        <button
          type="button"
          class="
            px-4
            border-r border-gray-200
            text-gray-500
            focus:outline-none
            focus:ring-2
            focus:ring-inset
            focus:ring-indigo-500
            md:hidden
          "
          @click="sidebarOpen = true"
        >
          <span class="sr-only">Open sidebar</span>
          <MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
        </button>

        <div class="flex-1 px-4 flex justify-between">
          <div class="flex-1 flex">
            <!-- <form class="w-full flex md:ml-0" action="#" method="GET">
              <label for="search-field" class="sr-only">Search</label>
              <div
                class="relative w-full text-gray-400 focus-within:text-gray-600"
              >
                <div
                  class="
                    absolute
                    inset-y-0
                    left-0
                    flex
                    items-center
                    pointer-events-none
                  "
                >
                  <SearchIcon class="h-5 w-5" aria-hidden="true" />
                </div>
                <input
                  id="search-field"
                  class="
                    block
                    w-full
                    h-full
                    pl-8
                    pr-3
                    py-2
                    border-transparent
                    text-gray-900
                    placeholder-gray-500
                    focus:outline-none
                    focus:placeholder-gray-400
                    focus:ring-0
                    focus:border-transparent
                    sm:text-sm
                  "
                  placeholder="Search"
                  type="search"
                  name="search"
                />
              </div>
            </form> -->
          </div>

          <div class="ml-4 flex items-center md:ml-6">
            <p class="mr-8">{{ $page.props.auth.user.name }}</p>
            <button
              @click="logout"
              type="button"
              class="
                bg-white
                p-1
                rounded-full
                text-gray-400
                hover:text-gray-500
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-indigo-500
              "
            >
              <span class="sr-only">Sign Out</span>
              <LogoutIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>

      <main class="px-8 py-8 bg-off-white h-screen">
        <!-- <AppFlashmessages /> -->
        <slot />
      </main>
    </div>
  </div>
</template>
