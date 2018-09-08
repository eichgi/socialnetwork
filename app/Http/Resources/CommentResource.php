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
            'user_name' => $this->user->name,
            'user_avatar' => 'https://aprendible.com/images/default-avatar.jpg',
            'body' => $this->body,
        ];
    }
}
