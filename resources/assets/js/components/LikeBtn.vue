<template>
    <button class="btn btn-link btn-sm" v-if="status.is_liked" dusk="unlike-btn" @click="unlike(status)">
        <i class="fa fa-thumbs-up text-primary mr-1"></i>
        <strong>TE GUSTA</strong>
    </button>
    <button class="btn btn-link btn-sm" v-else dusk="like-btn" @click="like(status)">
        <i class="far fa-thumbs-up text-primary mr-1"></i>
        ME GUSTA
    </button>
</template>

<script>
    export default {
        props: {
            status: {
                type: Object,
                required: true,
            }
        },
        methods: {
            like(status) {
                axios.post(`/statuses/${status.id}/likes`)
                    .then((res) => {
                        status.is_liked = true;
                        status.likes_count++;
                    });
            },
            unlike(status) {
                axios.delete(`/statuses/${status.id}/likes`)
                    .then((res) => {
                        status.is_liked = false;
                        status.likes_count--;
                    });
            },
        }
    }
</script>

<style scoped>

</style>