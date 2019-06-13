<template>
    <div class="control-set">
        <label :for="name"> {{ name | ucase }}</label>
        <input class="control-input" :type="type" :name="name" :value="value" :placeholder="name" @input="$emit('input', $event.target.value)">
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: null,
        },
        name: {
            type: String,
            default: () => 'title',
        },
        type: {
            type: String,
            default: () => 'text',
        }
    },
}
</script>
