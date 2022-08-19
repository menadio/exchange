<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/Authenticated.vue";
import { ArrowNarrowLeftIcon } from "@heroicons/vue/outline";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["user"]);

function deactivateUser(user) {
    Inertia.delete(route("users.destroy", user));
}
</script>

<template>
    <AppLayout>
        <!-- main content -->
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <Link :href="route('users.index')">
                        <span><ArrowNarrowLeftIcon class="h-6 w-6" /></span>
                    </Link>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        v-if="$page.props.auth.user.role === 'super admin'"
                        @click="deactivateUser(user.id)"
                        type="button"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto"
                    >
                        Deactivate Account
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
                        <div v-if="user.deactivated">
                            <div
                                class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    Deactivated On
                                </dt>
                                <dd
                                    class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                >
                                    {{ transaction.rate }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
