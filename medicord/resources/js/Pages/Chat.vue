<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Pusher from 'pusher-js';
import axios from 'axios';
import {store} from '@/Stores/store.js'
// 😍 import custom class trick
import LaravelUser from '@/Utils/LaravelUser';

const user = new LaravelUser(usePage().props);
const props = defineProps(['receiverId'])
let message = ''
console.log('user id receiver id->',user.id,props.receiverId);
// echo listen receiverId

//ordinamento ids
let sortedIdsArr = [user.id, props.receiverId].sort(function (a, b) {
    return a - b;
});
let channelId = sortedIdsArr.join('.')
//devo hasharli
window.Echo.private(`user.${channelId}`).listen('NewMessageSent', (event) => {
    store.messages.push(event.message);
    console.log(`[LARAVEL-ECHO-CHAT] -ordered user.${user.id}.${props.receiverId}: `, event.message);
});
// window.Echo.private(`user.${user.id}.${props.receiverId}`).listen('NewMessageSent', (event) => {
//     store.messages.push(event.message);
//     console.log(`[LARAVEL-ECHO-CHAT] user.${user.id}.${props.receiverId}: `, event.message);
// });

// window.Echo.private(`user.${props.receiverId}.${user.id}`).listen('NewMessageSent', (event) => {
//     store.messages.push(event.message);
//     console.log(`[LARAVEL-ECHO-CHAT] user.${props.receiverId}.${user.id}: `, event.message);
// });

const sendMessage = () => {
    
    axios.post("/chat/sendNewMessage", {
        receiverId: props.receiverId,
        message
    }) 
        .then(response => {
            console.log('/chat/sendNewMessage Response:', response.data);
        })
        .catch(error => {
            console.error('/chat/sendNewMessage Error:', error);
        });
}



</script>

<template>
    <div class="mx-6">
        Testing Events here -> : <br>

        <textarea v-model="message" name="message" id="message" cols="30" rows="10">
        </textarea> 
        <br>

        <button class="ext-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" @click="sendMessage">Send Message</button>
    </div>
    <div >
        Received Message from echo: 
        <div v-for="singleMessage in store.messages">
            {{ singleMessage }}
        </div>
    </div>
</template>
s
