<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user->name,
            'user_link' => $this->user->link(),
            'user_avatar' => $this->user->avatar(),
            'body' => $this->body,
            'likes_count' => $this->likesCount(),
            'is_liked' => $this->isLiked(),
        ];
    }
}
