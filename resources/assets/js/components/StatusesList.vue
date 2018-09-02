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
                <button v-if="status.is_liked">TE GUSTA</button>
                <button v-else dusk="like-btn" @click="like(status)">ME GUSTA</button>
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
            }
        }
    }
</script>

<style scoped>

</style>