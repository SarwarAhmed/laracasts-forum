<script>
import Favorite from "./Favorite.vue"

export default {
    components: { Favorite },

    props: ['attributes'],

    data() {
        return {
            editing: false,
            body: this.attributes.body
        }
    },

    methods: {
        update() {
            axios.patch('/replies/' + this.attributes.id, {
                body: this.body
            })

            this.editing = false

            flash('Updated!')
        },

        destroy() {
            axios.delete('/replies/' + this.attributes.id);

            $(this.$el).fadeOut(500);
        }
    }
}
</script>