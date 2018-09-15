<template>
    <button :class="getBtnClasses" @click="toggle()">
        <i :class="getIconClasses"></i>
        {{getText}}
    </button>
</template>

<script>
    export default {
        props: {
            model: {
                type: Object,
                required: true,
            },
            url: {
                type: String,
                required: true,
            }
        },
        computed: {
            getText() {
                return this.model.is_liked ? 'TE GUSTA' : 'ME GUSTA';
            },
            getBtnClasses() {
                return [
                    this.model.is_liked ? 'font-weight-bold' : '',
                    'btn', 'btn-link', 'btn-sm',
                ];
            },
            getIconClasses() {
                return [
                    this.model.is_liked ? 'fa' : 'far',
                    'fa-thumbs-up', 'text-primary mr-1',
                ];
            }
        },
        methods: {
            toggle() {
                let method = this.model.is_liked ? 'delete' : 'post';
                axios[method](this.url)
                    .then((res) => {
                        this.model.is_liked = !this.model.is_liked;
                        if (method === 'post') {
                            this.model.likes_count++;
                        } else {
                            this.model.likes_count--;
                        }
                    });
            },
        }
    }
</script>

<style scoped>

</style>