<template>
    <layout title="Home">
        <h1 class="mb-8 font-bold text-3xl">Home</h1>
        <p class="mb-12 leading-normal">Welcome to PHPStage!</p>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';

export default {
    components: {
        Layout,
    },
    props: {
        posts: Object,
    },
}
</script>
