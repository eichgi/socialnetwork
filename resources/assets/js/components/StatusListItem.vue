<template>
    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-3">
                <img class="rounded mr-3 shadow-sm" width="40px"
                     :src="status.user.avatar">
                <div>
                    <h5 class="mb-1"><a :href="status.user.link" v-text="status.user.name"></a></h5>
                    <div class="small text-muted" v-text="status.created_at.date"></div>
                </div>
            </div>
            <p class="card-text text-secondary" v-text="status.body"></p>
        </div>
        <div class="card-footer p-2 d-flex justify-content-between align-items-center">
            <like-button dusk="like-btn" :url="`/statuses/${status.id}/likes`" :model="status"></like-button>
            <div class="text-secondary mr-2">
                <i class="far fa-thumbs-up"></i>
                <span dusk="likes-count">{{status.likes_count}}</span>
            </div>
        </div>
        <div class="card-footer">
            <div v-for="comment in comments" class="mb-3">
                <div class="d-flex">
                    <img class="rounded shadow-sm mr-2" height="34px" width="34px" :src="comment.user.avatar"
                         :alt="comment.user.name">
                    <div class="flex-grow-1">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-secondary">
                                <a :href="comment.user.link"><strong>{{comment.user.name}}</strong></a>
                                {{comment.body}}
                            </div>
                        </div>
                        <small class="badge badge-primary badge-pill py-1 px-2 mt-1 float-right"
                               dusk="comment-likes-count">
                            <i class="fa fa-thumbs-up"></i>
                            {{comment.likes_count}}
                        </small>
                        <like-button class="comments-like-btn" dusk="comment-like-btn"
                                     :url="`/comments/${comment.id}/likes`"
                                     :model="comment"></like-button>
                    </div>
                </div>
            </div>
            <form @submit.prevent="addComment" v-if="isAuthenticated">
                <div class="d-flex align-items-center">
                    <img class="rounded shadow-sm float-left mr-2" width="34px"
                         :src="currentUser.avatar"
                         :alt="currentUser.user_name"/>
                    <div class="input-group">
                        <textarea class="form-control border-0 shadow-sm" name="comment" v-model="newComment"
                                  rows="1" placeholder="Escribe un comentario..." required></textarea>
                        <div class="input-group-append">
                            <button class="btn btn-primary" dusk="comment-btn">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
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
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            likeComment(comment) {
                axios.post(`/comments/${comment.id}/likes`)
                    .then(res => {
                        comment.likes_count++;
                        comment.is_liked = true;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            unlikeComment(comment) {
                axios.delete(`/comments/${comment.id}/likes`)
                    .then(res => {
                        comment.likes_count--;
                        comment.is_liked = false;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
        }
    }
</script>

<style scoped>

</style>