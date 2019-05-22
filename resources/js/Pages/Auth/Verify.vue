<template>
    <blank-layout>
        <div class="p-6 bg-blue-800 min-h-screen flex justify-center items-center">
            <div class="w-full max-w-sm">
                <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
                <div class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-10 py-12">
                        <h1 class="text-center font-bold text-3xl">Email Verification</h1>
                        <div class="mx-auto mt-6 w-24 border-b-2" />
                    </div>
                    <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex flex-col justify-between items-center">
                        <span class="text-sm text-gray-600 mb-4">
                            Before proceeding, please check your email for a verification link. If you did not receive the email, click
                            <inertia-link class="hover:underline" tabindex="-1" :href="route('password.request.form')">here to resend the verification email?</inertia-link>
                        </span>
                        <span class="flex justify-between text-sm text-gray-600 mb-4">
                            <inertia-link class="hover:underline" tabindex="-1" :href="route('home')">Home</inertia-link>
                            <inertia-link class="hover:underline" tabindex="-1" :href="route('login.form')">Login</inertia-link>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </blank-layout>
</template>

<script>
    import BlankLayout from '@/Shared/BlankLayout';

    export default {
        components: { BlankLayout },
    }
</script>
