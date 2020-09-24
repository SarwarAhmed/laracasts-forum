<template>
    <div class="mt-4">
        <div v-if="signedIn">
            <div class="form">
                <textarea name="body"
                          id="body"
                          class="form-control"
                          placeholder="Have something to say?"
                          rows="5"
                          required
                          v-model="body"
                ></textarea>
            </div>

            <button type="submit"
                    class="mt-2 btn btn-outline-primary"
                    @click="addReply"
            >Post</button>
        </div>

        <p class="text-center pt-2" v-else>
            Please <a href="/login"
            >Sign in</a> to participate to this discussion.
        </p>
    </div>
</template>

<script>
    export default {
        name: "NewReply",

        props: ['endpoint'],

        data() {
            return {
                body: '',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn
            }
        },

        methods: {
            addReply() {
                axios.post(this.endpoint, { body: this.body })
                    .then(({data}) => {
                        this.body = ''

                        this.$emit('created', data)
                    })
            }
        }
    }
</script>

<style>

</style>
