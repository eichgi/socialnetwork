<?php

namespace Tests\Unit\Models;

use App\Comment;
use App\Like;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_comment_belongs_to_a_user()
    {
        $comment = factory(Comment::class)->create();
        $this->assertInstanceOf(User::class, $comment->user);
    }

    function test_a_comment_morph_many_likes()
    {
        $comment = factory(Comment::class)->create();
        factory(Like::class)->create([
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment),
        ]);
        $this->assertInstanceOf(Like::class, $comment->likes->first());
    }
}
