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
    import 'at.js'
    import 'jquery.caret'

    export default {
        name: "NewReply",

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

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON("/api/users", {name: query}, function(usernames) {
                            callback(usernames)
                        });
                    }
                }
            })
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger')
                    })
                    .then(({data}) => {
                        this.body = ''

                        flash('Your reply has been posted.');

                        this.$emit('created', data)
                    })
            }
        }
    }
</script>

<style>

</style>
