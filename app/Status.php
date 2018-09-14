<?php

namespace App;

use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasLikes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
