<template>
    <layout title="About Me">
        <h1 class="w-2/3 uppercase text-3xl font-medium text-blue-900 border-b border-gray-600 pb-4 pt-4 mb-8">
            About Me
        </h1>
        <p class="text-xl md:text-2xl text-blue-800 font-normal mb-4 leading-normal tracking-normal">
            I began tinkering in web development about 15 years ago when I co-developed a client information system for a non-profit organization. Basically, the company wanted to move from a paper system to a web-accessible database-backed application. At the time, I had no experience in web development. No HTML, CSS, PHP, javascript... nothing. Fortunately, we knew that one of our clients had some experience in creating websites, so he spearheaded the project for us. Unfortunately, his experience was with Coldfusion. I spent the better part of 5 years, debugging, maintaining and adding features to a client information system written for the web in Coldfusion. Whatever your opinion of Coldfusion, it wasn't a pleasant experience, especially for a beginner.
        </p>
        <p class="text-xl md:text-2xl text-blue-800 font-normal mb-4 leading-normal tracking-normal">
            It wasn't until about 5 years later that my interest was piqued again. This time with Ruby on Rails. I dabbled for a while and eventually discovered Laravel. I dove head first into Laravel, and I've learned a lot over the past couple of years. Now, I find myself backtracking and learning the fundamentals of web development and PHP, which I missed trying to find a shortcut to success in programming.
        </p>
        <p class="text-xl md:text-2xl text-blue-800 font-normal mb-4 leading-normal tracking-normal">
            I've started this blog to track my experiences and to have a place to log what I'm learning. So this is more of a tool for me than anything else. However, maybe I'll write something that can be useful to others. Either way, I'm excited about what is to come.
        </p>
        <p class="text-xl md:text-2xl text-blue-800 font-normal mb-4 leading-normal tracking-normal">CRS</p>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';

export default {
    components: {
        Layout,
    },
}
</script>
