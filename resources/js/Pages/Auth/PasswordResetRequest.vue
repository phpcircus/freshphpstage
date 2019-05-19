<template>
    <blank-layout>
        <div class="p-6 bg-blue-800 min-h-screen flex justify-center">
            <div class="w-full max-w-sm">
                <form class="mt-8 bg-white rounded-lg shadow-double overflow-hidden" @submit.prevent="submit">
                    <div class="px-10 py-12">
                        <logo class="block mx-auto w-3/5 max-w-xs fill-white" height="50" />
                        <h1 class="text-center font-semibold text-xl text-gray-700 uppercase p-4">Send Reset Instructions</h1>
                        <div class="mx-auto mt-6 w-24 border-b-2" />
                        <text-input v-model="form.email" class="mt-10" label="Email" :errors="errors.email" type="email" autofocus autocapitalize="off" />
                    </div>
                    <div class="px-10 py-4 bg-grey-100 border-t border-grey-200 flex justify-between items-center">
                        <loading-button :loading="sending" class="btn-blue" type="submit">Send Instructions</loading-button>
                    </div>
                </form>
            </div>
        </div>
    </blank-layout>
</template>

<script>
import Logo from '@/Shared/Logo';
import TextInput from '@/Shared/TextInput';
import BlankLayout from '@/Shared/BlankLayout';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        LoadingButton,
        Logo,
        TextInput,
        BlankLayout,
    },
    props: {
        errors: {
            type: Object,
            default: () => ({}),
        },
    },
    data () {
        return {
            sending: false,
            form: {
                email: null,
            },
        }
    },
    mounted () {
        document.title = `Forgot Password | ${this.$page.app.name}`;
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.post(this.route('password.request.email'), {
                email: this.form.email,
            }).then(() => {
                this.sending = false;
            });
        },
    },
}
</script>
