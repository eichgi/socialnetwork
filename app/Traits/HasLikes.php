<?php

namespace App\Traits;

trait HasLikes
{
    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }

    public function unlike()
    {
        $this->likes()
            ->where([
                'user_id' => auth()->id()
            ])
            ->delete();
    }

    public function isliked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }
}
