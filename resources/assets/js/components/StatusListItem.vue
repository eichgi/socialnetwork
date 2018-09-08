<template>
    <div class="card mb-3 border-0 shadow-sm">
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
        <div class="card-footer p-2 d-flex justify-content-between align-items-center">
            <like-button :status="status" :key="status.id"></like-button>
            <div class="text-secondary mr-2">
                <i class="far fa-thumbs-up"></i>
                <span dusk="likes-count">{{status.likes_count}}</span>
            </div>
            <form @submit.prevent="addComment">
                <textarea name="comment" v-model="newComment"></textarea>
                <button dusk="comment-btn">Enviar</button>
            </form>
            <div v-for="comment in comments">{{comment.body}}</div>
        </div>
    </div>
</template>

<script>
    import LikeButton from './LikeBtn'

    export default {
        components: {
            LikeButton
        },
        data() {
            return {
                newComment: '',
                comments: this.status.comments,
            }
        },
        props: {
            status: {
                type: Object,
                required: true,
            }
        },
        methods: {
            addComment() {
                axios.post(`/statuses/${this.status.id}/comments`, {body: this.newComment})
                    .then(res => {
                        this.comments.push(res.data.data);
                        this.newComment = '';
                    });
            },
        }
    }
</script>

<style scoped>

</style>