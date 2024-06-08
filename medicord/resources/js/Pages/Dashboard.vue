<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Chat from '@/Pages/Chat.vue'
import {store} from '@/Stores/store.js'
// 😍 import custom class trick
import LaravelUser from '@/Utils/LaravelUser';

const user = new LaravelUser(usePage().props);
//dummy receiver
const urlParams = new URLSearchParams(window.location.search);
const receiverId = urlParams.get('r');
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>

            <h3 v-if="user.hasRole('doctor')">Sei un dottore !</h3>  
              </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
        
       <a class="p-3 m-3 rounded-md bg-green-500" :href="route('users.index')">Chatta con gli utenti</a>

      <!-- <Chat :receiverId="receiverId"/> -->
    </AuthenticatedLayout>

</template>
