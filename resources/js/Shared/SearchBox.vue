<template>
    <div class="flex flex-col">
        <div class="flex">
            <input v-model="query" class="w-200p md:w-300p border-2 border-blue-500 px-2 py-1 md:py-2 rounded -mt-1 shadow" placeholder="Search posts…" type="text" @input="performSearch">
        </div>
        <div v-if="query && query.length" class="border-2 border-gray-300 mt-1">
            <ul v-if="hits && hits.length" class="list-reset bg-white">
                <li v-for="hit in hits" :key="hit.id" class="border-b border-gray-300 text-left py-4 px-2">
                    <inertia-link :href="`posts/${hit.slug}`" class="hit text-xl font-light text-gray-800 hover:text-gray-600 no-underline break-normal" v-html="sanitize(hit._highlightResult.title.value)" />
                </li>
            </ul>
            <ul v-else class="list-reset bg-white">
                <li class="text-gray-500 text-sm font-medium p-2" role="alert">
                    <p>No posts found…</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { config } from 'Config';
import algoliasearch from 'algoliasearch/lite';

export default {
    data () {
        return {
            client: null,
            index: null,
            query: '',
            hits: null,
        };
    },
    created () {
        this.client = algoliasearch(config.algoliaId, config.algoliaSearch);
        this.index = this.client.initIndex('posts');
    },
    methods: {
        performSearch (event) {
            this.index.search({query: this.query}, (error, results) => {
                this.hits = results.hits;
            });
        },
        sanitize (text) {
            return text.replace(/<script[^>]*>.*?<\/script>/gi,'');
        },
    },
};
</script>
