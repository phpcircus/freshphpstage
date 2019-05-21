<template>
    <layout title="Home">
        <h1 class="w-2/3 uppercase text-3xl font-medium text-blue-900 border-b border-gray-600 pb-4 pt-4 mb-8">
            Latest Posts
        </h1>
        <div v-if="posts.length > 0">
            <div v-for="post in posts" :key="post.id" class="mb-8">
                <h2 class="font-medium text-2xl mb-2 md:text-3xl tracking-wide">
                    <inertia-link :href="route('post.show', post.slug)" class="text-blue-900 hover:text-blue-500 no-underline">{{ post.title }}</inertia-link>
                </h2>
                <p class="text-lg md:text-lg text-blue-800 font-normal tracking-normal">Posted: {{ post.createdAtDiff }}</p>
            </div>
        </div>
        <div v-else>
            <h2 class="font-medium text-lg mb-2 md:text-xl tracking-wide">No Posts Available</h2>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';

export default {
    components: {
        Layout,
    },
    props: {
        posts: Array,
    },
}
</script>
