<template>
    <layout title="Create Post">
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-blue-light hover:text-blue-700" :href="route('posts')">Posts</inertia-link>
            <span class="text-blue-300 font-medium">/</span> Create
        </h1>
        <div class="bg-white rounded shadow overflow-hidden max-w-lg">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <text-input v-model="form.title" :errors="errors.title" class="pr-6 pb-8 w-full lg:w-1/2" label="Post Title" />
                    <textarea-input v-model="form.body" :errors="errors.body" class="pr-6 pb-8 w-full lg:w-1/2" label="Post Content" rows="20" :autosize="true" />
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <loading-button :loading="sending" class="btn-blue" type="submit">Create Post</loading-button>
                </div>
            </form>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import TextInput from '@/Shared/TextInput';
import TextareaInput from '@/Shared/TextareaInput';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        Layout,
        LoadingButton,
        TextInput,
        TextareaInput,
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
                description: null,
            },
        }
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.post(this.route('posts.store'), this.form)
            .then(() => this.sending = false)
        },
    },
}
</script>
