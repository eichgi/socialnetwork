<template>
    <div>
        <div class="card mb-3 border-0 shadow-sm" v-for="status in statuses">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded mr-3 shadow-sm" width="40px"
                         src="https://aprendible.com/images/default-avatar.jpg">
                    <div>
                        <h5 class="mb-1" v-text="status.user_name"></h5>
                        <div class="small text-muted" v-text="status.created_at.date"></div>
                    </div>
                </div>
                <p class="card-text text-secondary" v-text="status.body"></p>
            </div>
            <div class="card-footer p-2">
                <button class="btn btn-link btn-sm" v-if="status.is_liked" dusk="unlike-btn" @click="unlike(status)">
                    <i class="fa fa-thumbs-up text-primary mr-1"></i>
                    <strong>TE GUSTA</strong>
                </button>
                <button class="btn btn-link btn-sm" v-else dusk="like-btn" @click="like(status)">
                    <i class="far fa-thumbs-up text-primary mr-1"></i>
                    ME GUSTA
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                statuses: [],
            }
        },
        mounted() {
            axios.get('/statuses')
                .then(res => {
                    this.statuses = res.data.data;
                })
                .catch(err => {
                    console.log(err.response.data);
                });

            EventBus.$on('status-created', status => {
                console.log(status);
                this.statuses.unshift(status);
            });
        },
        methods: {
            like(status) {
                axios.post(`/statuses/${status.id}/likes`)
                    .then((res) => {
                        status.is_liked = true;
                    });
            },
            unlike(status) {
                axios.delete(`/statuses/${status.id}/likes`)
                    .then((res) => {
                        status.is_liked = false;
                    });
            }
        }
    }
</script>

<style scoped>

</style>