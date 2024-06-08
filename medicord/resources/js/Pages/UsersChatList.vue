<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, onMounted } from 'vue';

const props = defineProps(['users'])
onMounted(() => {
    console.log(props.users);
});

</script>
<template>
    <AuthenticatedLayout>
        <div class="w-screen p-2">
            <div class=" p-4  bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">All Users</h3>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        Dashboard
                    </a>
                </div>
                <div class="flow-root" v-for="singleUser in props.users">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li v-if="singleUser.roles[0].id != '1'" class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">

                                    <img :src="singleUser.image" alt="Profile Image" class="w-8 h-8 rounded-full">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ singleUser.name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ singleUser.email }}
                                    </p>
                                </div>

                                <div>
                                    <button class="middle none center rounded-lg bg-pink-500 p-2 px-6 font-sans text-xs text- font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                                            
                                        <a :href="route('chat.index', { receiverId: singleUser.id })">Chat send</a>
                                    </button>
                                </div>


                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<style>
.cont {
    display: flex;
    justify-content: center;
}

a {
    all: unset;
}
</style>