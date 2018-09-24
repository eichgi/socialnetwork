<template>
    <button class="btn btn-primary btn-block" @click="sendFriendshipRequest" dusk="request-friendship">{{textBtn}}</button>
</template>

<script>
    export default {
        props: {
            recipient: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                textBtn: 'Solicitar amistad',
            }
        },
        methods: {
            sendFriendshipRequest() {
                axios.post(`friendships/${this.recipient.name}`)
                    .then(res => {
                        console.log(res);
                        this.textBtn = 'Solicitud enviada';
                    }).catch(error => {
                    console.log(error.response.data);
                });
            }
        }
    }
</script>

<style scoped>

</style>