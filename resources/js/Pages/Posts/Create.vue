<template>
    <layout title="Create Post">
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-blue-light hover:text-blue-700" :href="route('posts')">Posts</inertia-link>
            <span class="text-blue-300 font-medium">/</span> Create
        </h1>
        <div class="bg-white rounded shadow overflow-hidden w-full">
            <form class="w-3/4" @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-col">
                    <text-input v-model="form.title" :errors="errors.title" class="pr-6 pb-8 w-full lg:w-1/2" label="Post Title" />
                    <vue-trix v-model="form.body" class="post-content" placeholder="Enter content" @trix-attachment-add="storeAttachment" />
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <loading-button :loading="sending" class="btn-blue" type="submit">Create Post</loading-button>
                </div>
            </form>
        </div>
    </layout>
</template>

<script>
import VueTrix from 'vue-trix';
import Layout from '@/Shared/Layout';
import TextInput from '@/Shared/TextInput';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        Layout,
        LoadingButton,
        TextInput,
        VueTrix,
    },
    props: {
        errors: {
            type: Object,
            default: () => ({}),
        },
    },
    remember: 'form',
    data () {
        return {
            sending: false,
            form: {
                title: null,
                body: null,
            },
        }
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.post(this.route('posts.store'), this.form)
            .then(() => this.sending = false)
        },
        storeAttachment (event) {
            // let img = new Image();
            // img.onload = () => {
            //     console.log('size:', img.width + ', ' + img.height );
            // };
            // let file = event.attachment.file;
            // console.log(event);
        },
    },
}
</script>

<style>
.trix-button-row {
    display: flex;
    flex-wrap: wrap !important;
}
progress.attachment__progress {
    display: none;
}
</style>
