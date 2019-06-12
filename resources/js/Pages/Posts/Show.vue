<template>
    <layout title="Posts">
        <div class="w-full md:w-2/3">
            <h1 class="w-full md:w-4/5 uppercase text-2xl md:text-3xl font-medium text-blue-900 border-b border-gray-600 pb-4 pt-4 mb-8">
                <inertia-link class="text-blue-500 hover:text-blue-700" :href="route('posts')">Posts</inertia-link>
                <span class="text-blue-500 font-medium">/</span>
                {{ post.title }}
            </h1>
            <span class="block text-base text-blue-500 italic -mt-4 mb-4">{{ post.createdAtDiff }}</span>
            <div ref="trix" class="trix-content text-gray-800 text-base leading-normal" v-html="post.body" />
            <post-comments :comments="post.comments" :post="post" />
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import hljs from 'Libraries/highlightjs';
import PostComments from '@/Shared/PostComments';

export default {
    components: {
        Layout,
        PostComments,
    },
    props: {
        post: Object,
    },
    created () {
        document.querySelector('meta[name="og:url"]').setAttribute('content', 'https://phpstage.com/posts'+this.post.slug);
        document.querySelector('meta[name="og:title"]').setAttribute('content', this.post.title);
        document.querySelector('meta[name="og:description"]').setAttribute('content', this.post.summary);
    },
    mounted () {
        this.$refs.trix.querySelectorAll('pre').forEach((block) => {
            hljs.highlightBlock(block);
        });
    },
    destroyed () {
        document.querySelector('meta[name="og:url"]').setAttribute('content', 'https://phpstage.com');
        document.querySelector('meta[name="og:title"]').setAttribute('content', 'PHPStage');
        document.querySelector('meta[name="og:description"]').setAttribute('content', 'See the latest from PHPStage.com');
    },
}
</script>
