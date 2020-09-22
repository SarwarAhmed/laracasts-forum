<template>
    <button class="btn btn-sm d-flex align-items-center" :class="classes" type="submit" @click="toggle">
        <svg style="height: 18px; width: 18px;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
        <span class="ml-1" v-text="count"></span>
    </button>
</template>

<script>
export default {
    props: ['reply'],

    data() {
        return {
            count: this.reply.favoritesCount,
            active: this.reply.isFavorited
        }
    },

    computed: {
        classes() {
            return [this.active ? 'btn-primary' : 'btn-outline-primary']
        },

        endpoint() {
            return '/replies/' + this.reply.id + '/favorites'
        }
    },

    methods: {
        toggle() {
            this.active ? this.destroy() : this.create()
        },

        create() {
            axios.post(this.endpoint)

            this.active = true
            this.count++
        },

        destroy() {
            axios.delete(this.endpoint)

            this.active = false
            this.count--
        },
    }
}
</script>
