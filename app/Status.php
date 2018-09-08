<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }

    public function isliked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function unlike()
    {
        $this->likes()
            ->where([
                'user_id' => auth()->id()
            ])
            ->delete();
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }
}
