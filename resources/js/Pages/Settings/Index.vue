<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref, reactive } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    ExclamationIcon,
    XCircleIcon,
    XIcon,
    CheckCircleIcon,
    EyeIcon,
} from "@heroicons/vue/outline";
import AppLabel from "@/Components/Label.vue";
import AppInput from "@/Components/Input.vue";
import AppButton from "@/Components/Button.vue";

const props = defineProps(["user"]);
const form = reactive({
    // old_password: null,
    password: null,
    password_confirmation: null,
});
const show = ref(true);
const open = ref(false);

const showUpdateForm = () => {
    open.value = true;
};

const updatePassword = () => {
    Inertia.put(route("password.change"), form);
    open.value = false;
};
</script>

<template>
    <AppLayout>
        <!-- flash message -->
        <div class="px-4 sm:px-6 lg:px-8">
            <!-- success message -->
            <div
                v-if="$page.props.flash.success && show"
                class="my-8 rounded-md bg-green-50 p-4"
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
                            {{ $page.props.flash.success }}
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
                                <XIcon class="h-5 w-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- error message -->
            <div
                v-if="$page.props.flash.error && show"
                class="my-8 rounded-md bg-red-50 p-4"
            >
                <div class="flex">
                    <div class="flex-shrink-0">
                        <XCircleIcon
                            class="h-5 w-5 text-red-400"
                            aria-hidden="true"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ $page.props.flash.error }}
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
                                <XIcon class="h-5 w-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- users -->
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">
                        Manage Settings
                    </h1>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        @click="showUpdateForm"
                        type="button"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                    >
                        Update Password
                    </button>
                </div>
            </div>

            <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        User Details
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Specific details of the user.
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Name
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ user.name }}
                            </dd>
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Email
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ user.email }}
                            </dd>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Role
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ user.role }}
                            </dd>
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Account Created On
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ user.created_at }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- password update modal -->
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
                                    Password Update
                                </DialogTitle>

                                <form @submit.prevent="updatePassword">
                                    <!-- <div class="mt-4">
                                        <AppLabel value="Old Password" />
                                        <div class="mt-1">
                                            <AppInput
                                                v-model="form.old_password"
                                                type="password"
                                                required
                                                class="w-full"
                                            />
                                        </div>
                                    </div> -->

                                    <div class="mt-4">
                                        <AppLabel value="New Password" />
                                        <div class="mt-1">
                                            <AppInput
                                                v-model="form.password"
                                                type="password"
                                                required
                                                class="w-full"
                                            />
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <AppLabel value="Confirm Password" />
                                        <div class="mt-1">
                                            <AppInput
                                                v-model="
                                                    form.password_confirmation
                                                "
                                                type="password"
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
