<template>
    <div>
        <vue-snotify />
        <slot />
    </div>
</template>

<script>
    import HasNotifications from 'Mixins/HasNotifications';

    export default {
        mixins: [ HasNotifications ],
    }
</script>

<style>

</style>
