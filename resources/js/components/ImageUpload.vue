<template>
    <input type="file" accept="image/*" @change="onChange">
</template>

<script>
    export default {
        name: "ImageUpload",

        methods: {
            onChange(e)
            {
                if (!e.target.files.length) return

                let file = e.target.files[0]

                let render = new FileReader()

                render.readAsDataURL(file)

                render.onload = e => {
                    let src = e.target.result

                    this.$emit('loaded', { src, file })
                }
            }
        }
    }
</script>
