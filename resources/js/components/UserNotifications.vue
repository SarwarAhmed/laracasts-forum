<template>
    <div v-if="notifications.length">
        <div class="nav-item dropdown">
            <a class="nav-link text-warning" href="#" data-toggle="dropdown">
                <!--svg https://heroicons.com -->
                <svg style="width: 20px; fill: currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div v-for="notification in notifications">
                    <a :href="notification.data.link"
                       class="dropdown-item"
                       @click="markAsRead(notification)"
                    >
                        <p class="text-muted" v-text="notification.data.message"></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserNotifications",

        data() {
            return { notifications: null }
        },

        created() {
            axios.get("/profiles/" + window.App.user.name + "/notifications")
                .then(response => this.notifications = response.data)
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>
