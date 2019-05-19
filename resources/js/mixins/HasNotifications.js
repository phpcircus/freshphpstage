export default {
    props: {
        notification: String,
        warning: String,
    },
    mounted () {
        if (this.notification) {
            this.$snotify.success(this.notification, 'Success!');
        }
        if (this.warning) {
            this.$snotify.error(this.warning, 'Oops!');
        }
        this.clearNotifications();
    },
    methods: {
        clearNotifications () {
            this.clearStoredMessages();
            this.clearSnotify();
        },
        clearSnotify () {
            setTimeout(() => {
                this.$snotify.clear();
            }, 3000);
        },
        clearStoredMessages () {
            this.$store.notification = null;
            this.$store.warning = null;
        },
    },
    watch: {
        notification (notification) {
            if (notification) {
                this.$snotify.success(notification, 'Success!');
            }
        },
        warning (warning) {
            if (warning) {
                this.$snotify.error(warning, 'Oops!');
            }
        },
    },
}
