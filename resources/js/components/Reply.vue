<template>
    <div>
        <br>
        <div :id="'reply-'+id" class="card">
            <div class="card-header " :class="isBest ? 'badge-success' : ''">
                <div class="input-group-append justify-content-between">
                    <h5>
                        <a :href="'/profiles/'+data.owner.name"
                           v-text="data.owner.name"
                        ></a> said <span v-text="ago"></span>
                    </h5>

                    <div v-if="signedIn">
                        <favorite :reply="data"></favorite>
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

            <div class="card-footer input-group-append">
                <div v-if="canUpdate">
                    <button class="btn btn-sm btn-outline-secondary mr-3" @click="editing = true">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
                </div>
                
                <button class="btn btn-sm btn-outline-primary ml-auto" @click="markBestReply" v-show="! isBest">Best Reply?</button>
            </div>
        </div>
    </div>
</template>

<script>
import Favorite from "./Favorite.vue"
import moment from "moment"

export default {
    components: { Favorite },

    props: ['data'],

    data() {
        return {
            editing: false,
            id: this.data.id,
            body: this.data.body,
            isBest: false,
        }
    },

    computed: {
        ago() {
            return moment(this.data.created_at).fromNow() + '...'
        },

        signedIn() {
            return window.App.signedIn
        },

        canUpdate() {
            return this.authorize(user => this.data.user_id == user.id)
        }
    },

    methods: {
        update() {
            axios.patch('/replies/' + this.data.id, {
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
            axios.delete('/replies/' + this.data.id);

            this.$emit('deleted', this.data.id)

            $(this.$el).fadeOut(500);
        },

        markBestReply() {
            this.isBest = true
        }
    }
}
</script>
