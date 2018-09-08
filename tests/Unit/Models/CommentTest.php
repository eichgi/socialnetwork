<?php

namespace Tests\Unit\Models;

use App\Comment;
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
}
