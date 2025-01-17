<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import ProfilePicUpdater from '../ProfilePicUpdater.vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;


let form = useForm({
    name: user.name,
    email: user.email,
    phone_number: user.phone_number,
    address: user.address,
    specialization: user.doctor ? user.doctor.specialization || '' : '',
    meeting_link: user.doctor ? user.doctor.meeting_link || '' : '',

});



</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information. {{ user.doctor }}
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link :href="route('verification.send')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Click here to re-send the verification email.
                    </Link>
                </p>

                <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            </div>
            <div>
                <InputLabel for="phone_number" value="Phone Number" />

                <TextInput id="phone_number" type="text" class="mt-1 block w-full" v-model="form.phone_number" autocomplete="phone_number" />

                <InputError class="mt-2" :message="form.errors.phone_numbers" />
            </div>
            <div>
                <InputLabel for="address" value="address" />

                <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" autocomplete="phone_number" />

                <InputError class="mt-2" :message="form.errors.phone_numbers" />
            </div>
            <!--🧑‍⚕️ doctor section -->
            <div v-if="user.doctor">
                <InputLabel for="specialization" value="Specialization" />

                <TextInput id="specialization" type="text" class="mt-1 block w-full" v-model="form.specialization" autocomplete="specialization" />

                <InputError class="mt-2" :message="form.errors.specializations" />

                <InputLabel for="meeting_link" value="meeting link" />

                <TextInput id="meeting_link" type="text" class="mt-1 block w-full" v-model="form.meeting_link" autocomplete="meeting_link" />

                <InputError class="mt-2" :message="form.errors.meeting_links" />
            </div>
     <ProfilePicUpdater/>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>

      
    </section>
</template>

<script>



</script>