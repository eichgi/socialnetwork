<template>
    <div>
        <form @submit.prevent="submit" v-if="isAuthenticated">
            <div class="card-body">
            <textarea v-model="body" class="form-control border-0 bg-light" name="body"
                      :placeholder="`¿Qué estás pensando ${currentUser.name}?`"></textarea>
            </div>
            <div class="card-footer">
                <button id="create-status" class="btn btn-primary">
                    <i class="fa fa-paper-plane mr-1"></i>
                    Publicar
                </button>
            </div>
        </form>
        <div class="card-body" v-else>
            <a href="/login">Debes hacer login</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
            }
        },
        //mixins: [auth],
        methods: {
            submit() {
                axios.post('/statuses', {body: this.body})
                    .then(res => {
                        EventBus.$emit('status-created', res.data.data);
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