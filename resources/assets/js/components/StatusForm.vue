<template>
    <div>
        <form @submit.prevent="submit">
            <div class="card-body">
            <textarea v-model="body" class="form-control border-0 bg-light" name="body"
                      placeholder="¿Qué estás pensando papi?"></textarea>
            </div>
            <div class="card-footer">
                <button id="create-status" class="btn btn-primary">Publicar</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
            }
        },
        methods: {
            submit() {
                axios.post('/statuses', {body: this.body})
                    .then(res => {
                        EventBus.$emit('status-created', res.data);
                        this.body = '';
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })
            },
        }
    }
</script>

<style scoped>

</style>