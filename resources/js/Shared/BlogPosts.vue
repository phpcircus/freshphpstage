<template>
    <div>
        <div v-for="post in posts" :key="post.id" class="post-container py-8 border-b-4 border-gray-300">
            <h2 class="font-medium text-2xl mb-2 md:text-3xl tracking-wide">
                <inertia-link :href="route('post.show', post.slug)" class="text-blue-900 hover:text-blue-500 no-underline">{{ post.title }}</inertia-link>
            </h2>
            <p class="text-lg md:text-sm text-blue-800 font-normal italic tracking-normal mb-4">Posted: {{ post.createdAtDiff }}</p>
            <p class="text-sm md:text-base text-gray-700 font-normal leading-normal"> {{ post.summary }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        posts: Array,
    },
}
</script>
