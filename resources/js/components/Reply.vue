<template>
    <div>
        <br>
        <div :id="'reply-'+id" class="card">
            <div class="card-header " :class="isBest ? 'badge-success' : ''">
                <div class="input-group-append justify-content-between">
                    <h5>
                        <a :href="'/profiles/' + reply.owner.name"
                           v-text="reply.owner.name"
                        ></a> said <span v-text="ago"></span>
                    </h5>

                    <div v-if="signedIn">
                        <favorite :reply="reply"></favorite>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div v-if="editing">
                    <form @submit="update">
                        <div class="form-group">
                            <textarea class="form-control" v-model="body" required></textarea>
                        </div>

                        <button class="btn btn-sm btn-primary mr-2">Update</button>
                        <button class="btn btn-sm btn-link" @click="editing = false" type="button">Cancel</button>
                    </form>
                </div>

                <div v-else v-html="body"></div>
            </div>

            <div class="card-footer input-group-append" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
                <div v-if="authorize('owns', reply)">
                    <button class="btn btn-sm btn-outline-secondary mr-3" @click="editing = true">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
                </div>

                <button class="btn btn-sm btn-outline-primary ml-auto" @click="markBestReply" v-if="authorize('owns', reply.thread)">Best Reply?</button>
            </div>
        </div>
    </div>
</template>

<script>
import Favorite from "./Favorite.vue"
import moment from "moment"

export default {
    components: { Favorite },

    props: ['reply'],

    data() {
        return {
            editing: false,
            id: this.reply.id,
            body: this.reply.body,
            isBest: this.reply.isBest,
        }
    },

    computed: {
        ago() {
            return moment(this.reply.created_at).fromNow() + '...'
        },
    },

    created() {
        window.events.$on('best-reply-selected', id => {
            this.isBest = (id === this.id)
        })
    },

    methods: {
        update() {
            axios.patch('/replies/' + this.id, {
                body: this.body
            })
            .catch(error => {
                flash(error.response.data, 'danger')
                this.editing = true
            })

            this.editing = false

            flash('Updated!')
        },

        destroy() {
            axios.delete('/replies/' + this.id);

            this.$emit('deleted', this.id)

            $(this.$el).fadeOut(500);
        },

        markBestReply() {
            axios.post('/replies/' + this.id + '/best')

            window.events.$emit('best-reply-selected', this.id)
        }
    }
}
</script>
