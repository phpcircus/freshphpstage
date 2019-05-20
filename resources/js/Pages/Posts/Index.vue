<template>
    <layout title="Posts">
        <h1 class="uppercase text-3xl font-medium text-blue-900 border-b border-gray-600 pb-4 pt-4 mb-8">
            Posts
        </h1>
        <div v-if="posts.data.length > 0">
            <div v-for="post in posts.data" :key="post.id" class="mb-8">
                <h2 class="font-medium text-2xl mb-2 md:text-3xl tracking-wide">
                    <inertia-link :href="route('post.show', post.slug)" class="text-blue-900 hover:text-blue-500 no-underline">{{ post.title }}</inertia-link>
                </h2>
                <p class="text-lg md:text-lg text-blue-800 font-normal tracking-normal">Posted: {{ post.createdAtDiff }}</p>
            </div>
        </div>
        <div v-else>
            <h2 class="font-medium text-lg mb-2 md:text-xl tracking-wide">No Posts Available</h2>
        </div>
        <div v-if="posts.data.length > 0">
            <pagination :links="posts.links" />
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import Pagination from '@/Shared/Pagination';

export default {
    components: {
        Layout,
        Pagination,
    },
    props: {
        posts: Object,
    },
}
</script>

<style>

</style>
