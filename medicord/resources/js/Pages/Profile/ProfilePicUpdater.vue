<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const form = useForm({
    photo_url: ''
});

const setPhotoUrl = (e) => {
    form.photo_url = e.target.files[0];
}

const user = computed(() => usePage().props.user);

const uploadFile = () => {
    form.post(route('profile.photo'), {
        onSuccess: () => {
            form.reset('photo_url')
        }
    });
}
</script>                                                         
<template>
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-5">
            <div v-if="$page.props.flash.message" :class="`my-3 ${$page.props.flash.class}`">
                {{ $page.props.flash.message }}
            </div>
            <div v-if="form.errors.photo_url" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.photo_url }}</div>
            <div class="md:col-span-1">
                <div class="card">
                    <div class="card-body">
                        <img :src="user.image" alt="Profile Image" class="w-full h-auto rounded">
                        <form @submit.prevent="uploadFile" class="mt-3">
                            <label for="formFile" class="block">Change profile image</label>
                            <input type="file" @input="setPhotoUrl" id="formFile" class="form-input mt-1">
                            <div class="mt-2">
                                <button :disabled="!form.photo_url" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</template>




<style></style>
                                                            
                                                        