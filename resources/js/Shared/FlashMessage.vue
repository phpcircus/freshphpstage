<template>
    <vue-snotify />
</template>

<script>
export default {
    watch: {
        '$page.success': {
            handler (value) {
                if (value.success) {
                    this.$snotify.success(this.$page.success.success, 'Success!');
                }
            },
            deep: true,
        },
        '$page.warning': {
            handler (value) {
                if (value.warning) {
                    this.$snotify.error(this.$page.warning.warning, 'Oops!');
                }
            },
            deep: true,
        },
    },
    mounted () {
        if (this.$page.success.success) {
            this.$snotify.success(this.$page.success.success, 'Success!').on('destroyed', () => {
                console.log('toast destroyed');
            });
        }

        if (this.$page.warning.warning) {
            this.$snotify.error(this.$page.warning.warning, 'Oops!');
        }
    },
}
</script>

<style>

</style>
