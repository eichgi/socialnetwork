<?php

namespace Tests\Unit\Http\Resources;

use App\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Resources\StatusResource;
use App\Status;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_status_resources_must_have_the_necessary_fields()
    {
        $status = factory(Status::class)->create();
        factory(Comment::class)->create(['status_id' => $status->id]);
        $statusResource = StatusResource::make($status)->resolve();
        //dd($statusResource);
        $this->assertEquals($status->id, $statusResource['id']);
        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->user->name, $statusResource['user_name']);
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $statusResource['user_avatar']);
        //$this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);
        //dd($statusResource['created_at']->format('d-m-y'));
        $this->assertEquals($status->created_at->format('d/m/Y'), $statusResource['created_at']->format('d/m/Y'));
        $this->assertEquals(false, $statusResource['is_liked']);
        $this->assertEquals(0, $statusResource['likes_count']);
        //dd($statusResource['comments']->first()->resource);
        $this->assertEquals(CommentResource::class, $statusResource['comments']->collects);
        $this->assertInstanceOf(Comment::class, $statusResource['comments']->first()->resource);
    }
}
