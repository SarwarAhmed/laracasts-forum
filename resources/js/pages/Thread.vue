<script>
    import Replies from "../components/Replies.vue";
    import SubscribeButton from "../components/SubscribeButton";

    export default {
        props: ['dataRepliesCount', 'dataLocked'],

        components: { Replies, SubscribeButton },

        data() {
            return {
                repliesCount: this.dataRepliesCount,
                locked: this.dataLocked,
            }
        }
    }
</script>
