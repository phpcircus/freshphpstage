<template>
    <layout title="Home">
        <h1 class="w-2/3 uppercase text-3xl font-medium text-blue-900 pb-4 pt-4 mb-8">
            Latest Posts
        </h1>
        <div v-if="posts.length > 0" class="w-full md:w-1/2">
            <blog-posts :posts="posts" />
        </div>
        <div v-else>
            <h2 class="font-medium text-lg mb-2 md:text-xl tracking-wide">No Posts Available</h2>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import BlogPosts from '@/Shared/BlogPosts';

export default {
    components: {
        Layout,
        BlogPosts,
    },
    props: {
        posts: Array,
    },
}
</script>
