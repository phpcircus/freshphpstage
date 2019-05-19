<template>
    <div>
        <portal-target name="dropdown" slim />
        <vue-snotify />
        <div class="flex flex-col">
            <div class="min-h-screen flex flex-col" @click="hideDropdownMenus">
                <div class="md:flex">
                    <div class="bg-blue-900 md:flex-no-shrink w-full md:w-2/7 lg:w-1/7 px-6 py-4 flex items-center justify-between md:justify-center">
                        <inertia-link class="mt-1" href="/">
                            <logo class="fill-white" width="120" height="28" />
                        </inertia-link>
                        <dropdown class="md:hidden" placement="bottom-end">
                            <svg class="fill-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
                            <div slot="dropdown" class="mt-2 px-8 py-4 shadow-lg bg-blue-800 rounded">
                                <main-menu />
                            </div>
                        </dropdown>
                    </div>
                    <div class="flex w-full md:w-5/7 lg:w-6/7 bg-white border-b p-4 md:py-0 md:px-12 text-sm md:text-base flex justify-between items-center">
                        <div class="mt-1 mr-4">&nbsp;</div>
                        <dropdown class="mt-1 md:ml-auto " placement="bottom-end">
                            <div class="flex items-center cursor-pointer select-none group">
                                <div class="text-gray-900 group-hover:text-blue-700 focus:text-blue-700 mr-1 whitespace-no-wrap">
                                    <span class="inline">{{ $page.auth.user.name }}</span>
                                </div>
                                <icon class="w-5 h-5 group-hover:fill-blue-700 fill-gray-900 focus:fill-blue-700" name="cheveron-down" />
                            </div>
                            <div slot="dropdown" class="mt-2 py-2 shadow-lg bg-white rounded text-sm">
                                <inertia-link class="block px-6 py-2 hover:bg-blue-500 hover:text-white" :href="route('users.edit', $page.auth.user.id)">My Profile</inertia-link>
                                <inertia-link class="block px-6 py-2 hover:bg-blue-500 hover:text-white" :href="route('users')">Manage Users</inertia-link>
                                <inertia-link class="block px-6 py-2 hover:bg-blue-500 hover:text-white" :href="route('logout')" method="post">Logout</inertia-link>
                            </div>
                        </dropdown>
                    </div>
                </div>
                <div class="flex flex-grow w-full">
                    <div class="bg-blue-800 flex-no-shrink w-2/7 lg:w-1/7 p-12 hidden md:block">
                        <main-menu />
                    </div>
                    <div class="overflow-hidden px-4 py-8 md:p-12 w-full md:w-5/7 lg:w-6/7">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Icon from '@/Shared/Icon';
    import Logo from '@/Shared/Logo';
    import Dropdown from '@/Shared/Dropdown';
    import MainMenu from '@/Shared/MainMenu';
    import HasNotifications from 'Mixins/HasNotifications';

    export default {
        components: {
            Dropdown,
            Icon,
            Logo,
            MainMenu,
        },
        mixins: [ HasNotifications ],
        props: {
            title: String,
        },
        data () {
            return {
                showUserMenu: false,
                accounts: null,
            }
        },
        watch: {
            title (title) {
                this.updatePageTitle(title);
            },
        },
        mounted () {
            this.updatePageTitle(this.title);
        },
        methods: {
            updatePageTitle (title) {
                document.title = title ? `${title} | ${this.$page.app.name}` : this.$page.app.name;
            },
            hideDropdownMenus () {
                this.showUserMenu = false;
            },
        },
    }
</script>
