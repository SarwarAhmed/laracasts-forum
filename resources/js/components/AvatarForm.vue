<template>
    <div>
        <div class="row mb-4">
            <img :src="avatar" alt="avatar" class="mr-2 rounded-circle" width="50" height="50">

            <h1 v-text="user.name"></h1>
        </div>

        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" class="mr-2" @loaded="onLoad"></image-upload>
        </form>

    </div>
</template>

<script>
    import ImageUpload from "./ImageUpload"

    export default {
        name: "AvatarForm",

        props: ['user'],

        components: { ImageUpload },

        data() {
            return {
                avatar: this.user.avatar_path
            }
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id)
            }
        },

        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src

                this.persist(avatar.file)
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar)

                axios.post(`/api/users/${this.user.name}/avatar`, data)
                    .then(() => flash('Your profile picture has been uploaded!'))
            }
        }
    }
</script>
