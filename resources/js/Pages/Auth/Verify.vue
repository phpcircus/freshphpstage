<template>
    <blank-layout>
        <div class="px-6 bg-blue-800 min-h-screen flex justify-center pt-32">
            <div class="w-full max-w-sm">
                <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
                <div class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-10 pt-12 pb-4">
                        <h1 class="text-center font-bold text-3xl">Email Verification</h1>
                        <div class="mx-auto mt-6 w-24 border-b-2" />
                    </div>
                    <div class="leading-snug px-10 py-4 bg-gray-100 border-t border-gray-200 flex flex-col justify-between items-center">
                        <span class="text-base text-gray-600 mb-8">
                            If you did not receive a verification email upon registering, or if the link has expired, please
                            <inertia-link class="hover:underline text-blue-500" tabindex="-1" :href="route('verification.resend')">click here </inertia-link>
                            to resend.
                        </span>
                        <span class="flex self-start text-sm text-gray-600 mb-4">
                            <inertia-link class="btn-text mr-auto" tabindex="-1" :href="route('home')">Home</inertia-link>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </blank-layout>
</template>

<script>
    import Logo from '@/Shared/Logo';
    import BlankLayout from '@/Shared/BlankLayout';

    export default {
        components: { BlankLayout, Logo },
    }
</script>
