<template>
    <div class="mt-8">
        <h1 class="text-xl font-semibold text-blue-900 uppercase">Comments</h1>
        <div class="w-full md:w-2/3 mt-6 mt-4 flex flex-col bg-white shadow-md border-t-4 border-blue-400">
            <div v-for="comment in comments" :key="comment.id" class="leading-snug flex px-4 py-6 mb-4 items-center">
                <div class="flex flex-col mr-6 border-r-2 boder-gray-400 items-center w-100p md:w-200p">
                    <span class="text-lg text-gray-700 font-semibold italic whitespace-no-wrap">{{ comment.user.display_name }}</span>
                    <span class="hidden md:block text-sm text-gray-500 whitespace-no-wrap">{{ commentDate(comment.created_at) }}</span>
                </div>
                <div class="flex flex-col flex-1 pr-2">
                    <span class="text-base text-gray-700">{{ comment.body }}</span>
                    <div class="block md:hidden py-2">
                        <span class="text-sm text-gray-500">{{ commentDate(comment.created_at) }}</span>
                    </div>
                </div>
            </div>
            <div v-if="comments.length < 1" class="leading-snug flex px-4 py-6 mb-4 items-center">
                <span class="text-lg text-gray-700 font-semibold italic whitespace-no-wrap">No comments.</span>
            </div>
        </div>
        <div v-if="$page.auth.user && $page.auth.user.email_verified_at" class="w-full md:w-2/3 bg-white border-t-4 border-blue-400 shadow overflow-hidden mt-4">
            <form @submit.prevent="submit">
                <honey-input v-model="form.checker" name="first_name" type="name" />
                <div class="p-8 -mr-6 -mb-12 flex flex-wrap">
                    <textarea-input v-model="form.body" :errors="$page.errors.body" class="pr-6 pb-8 w-full" label="Comment" />
                </div>
                <div class="text-xs text-gray-500 italic text-center">Comment posting is protected by Google reCAPTCHA v3.</div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <loading-button :loading="sending" class="btn-blue bg-blue-500" type="submit">Leave Comment</loading-button>
                </div>
            </form>
        </div>
        <div v-else-if="$page.auth.user" class="w-full md:w-2/3 bg-white rounded shadow overflow-hidden mt-4 px-4 py-8">
            <span class="text-xl font-semibold text-blue-900 uppercase">
                <span>Before commenting, please </span>
                <inertia-link :href="route('verification.notice')" class="text-blue-500 font-semibold">
                    click here
                </inertia-link>
                <span> to verify your account.</span>
            </span>
        </div>
        <div v-else class="w-full md:w-2/3 bg-white rounded shadow overflow-hidden mt-4 px-4 py-8">
            <span class="text-xl font-semibold text-blue-900 uppercase">
                <inertia-link :href="route('login.form')" class="text-blue-500 font-semibold">
                    Sign in
                </inertia-link>
                <span> or</span>
                <inertia-link :href="route('register.form')" class="text-blue-500 font-semibold">
                    Register
                </inertia-link>
                <span> to comment.</span>
            </span>
        </div>
    </div>
</template>

<script>
import { config } from 'Config';
import { load } from 'recaptcha-v3'
import moment from 'moment-timezone';
import HoneyInput from '@/Shared/HoneyInput';
import TextareaInput from '@/Shared/TextareaInput';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        TextareaInput,
        LoadingButton,
        HoneyInput,
    },
    props: {
        post: Object,
        comments: Array,
        start: String,
    },
    data () {
        return {
            sending: false,
            form: {
                body: null,
                token: null,
                action: 'comment',
                time: this.start,
                checker: null,
            },
        }
    },
    methods: {
        commentDate (date) {
            return moment.utc(date).fromNow();
        },
        submit () {
            this.sending = true;
            load(config.recaptchaKey).then((recaptcha) => {
                recaptcha.execute('comment').then((token) => {
                    this.form.token = token;
                    this.$inertia.post(this.route('comments.store', { post: this.post.slug }), this.form)
                        .then(() => {
                            this.resetForm();
                        });
                });
            });
        },
        resetForm () {
            this.sending = false;
            this.form.body = null;
            this.form.token = null;
        },
    },
}
</script>

<style>

</style>
