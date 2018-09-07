<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use App\Http\Resources\StatusResource;
use App\Status;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_comment_resources_must_have_the_necessary_fields()
    {
        $comment = factory(Status::class)->create();
        $commentResource = CommentResource::make($comment)->resolve();

        //$this->assertEquals($comment->id, $commentResource['id']);
        $this->assertEquals($comment->body, $commentResource['body']);
        /*$this->assertEquals($comment->user->name, $commentResource['user_name']);
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $commentResource['user_avatar']);
        $this->assertEquals($comment->created_at->format('d/m/Y'), $commentResource['created_at']->format('d/m/Y'));
        $this->assertEquals(false, $commentResource['is_liked']);
        $this->assertEquals(0, $commentResource['likes_count']);*/
    }
}
