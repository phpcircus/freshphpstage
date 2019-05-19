<template>
    <blank-layout>
        <div class="p-6 bg-blue-800 min-h-screen flex justify-center">
            <div class="w-full max-w-sm">
                <form class="mt-8 bg-white rounded-lg shadow-double overflow-hidden" @submit.prevent="submit">
                    <div class="px-10 py-12">
                        <logo class="block mx-auto w-3/5 max-w-xs fill-white" height="50" />
                        <h1 class="text-center font-semibold text-xl text-gray-700 uppercase p-4">Choose a new password</h1>
                        <div class="mx-auto mt-6 w-24 border-b-2" />
                        <text-input v-model="form.email" class="mt-10" label="Email" :errors="errors.email" type="email" autofocus autocapitalize="off" />
                        <div v-if="errors.token" class="form-error">{{ errors.token[0] }}</div>
                        <text-input v-model="form.password" class="mt-10" label="Password" :errors="errors.password" type="password" />
                        <text-input v-model="form.password_confirmation" class="mt-10" label="Confirm Password" type="password" />
                    </div>
                    <div class="px-10 py-4 bg-grey-100 border-t border-grey-200 flex justify-between items-center">
                        <loading-button :loading="sending" class="btn-blue" type="submit">Change Password</loading-button>
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
        token: String,
        email: String,
    },
    data () {
        return {
            sending: false,
            form: {
                email: null,
                password: null,
                password_confirmation: null,
            },
        }
    },
    mounted () {
        document.title = `Change Password | ${this.$page.app.name}`;
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.post(this.route('password.update'), {
                email: this.form.email,
                password: this.form.password,
                password_confirmation: this.form.password_confirmation,
                token: this.token,
            }).then(() => {
                this.sending = false;
            });
        },
    },
}
</script>
