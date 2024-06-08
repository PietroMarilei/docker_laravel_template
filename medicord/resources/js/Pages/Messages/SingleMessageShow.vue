
<script>
export default {
    data() {
        return {
        };
    },
    props: {
        messages: Array
    },
    methods: {

    },
    created() {

    },
    mounted() {
        console.log(messages);
    },
};
</script>

<template>
    <h1>All your messages from {{ messages[0].sender_id }}</h1>
    <ul>
        <li class=" list-disc m-2" v-for="message in messages" :key="message.id">
            receiver_id-> :{{ message.receiver_id }}
            <br>
            sender id: {{ message.sender_id }} <br>
            testo del mess: ->
            {{ message.message_body }}
        </li>
    </ul>
</template>

<style scoped></style>