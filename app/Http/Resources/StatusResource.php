<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
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
            'body' => $this->resource->body,
            'user_name' => $this->user->name,
            'user_avatar' => 'https://aprendible.com/images/default-avatar.jpg',
            //'ago' => $this->created_at->diffForHumans(),
            'created_at' => $this->created_at
        ];
    }
}
