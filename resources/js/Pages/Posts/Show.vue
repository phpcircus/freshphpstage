<template>
    <layout title="Posts">
        <h1 class="uppercase text-3xl font-medium text-blue-900 border-b border-gray-600 pb-4 pt-4 mb-8">
            <inertia-link class="text-blue-500 hover:text-blue-700" :href="route('posts')">Posts</inertia-link>
            <span class="text-blue-500 font-medium">/</span>
            {{ post.title }}
        </h1>
        <span class="block text-base text-blue-500 italic -mt-4 mb-4">{{ post.createdAtDiff }}</span>
        <div id="post-body" v-html="post.body" />
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';

export default {
    components: {
        Layout,
    },
    props: {
        post: Object,
    },
}
</script>

<style>

</style>
