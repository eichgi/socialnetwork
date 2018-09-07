<?php

namespace Tests\Feature;

use App\Status;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCommentsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guest_users_cannot_create_comments()
    {
        $status = factory(Status::class)->create();
        $comment = ['body' => 'Mi primer comentario'];
        $response = $this->postJson(route('statuses.comments.store', $status), $comment);

        $response->assertStatus(401);

    }

    public function test_an_authenticated_user_can_comment_statuses()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();
        $comment = ['body' => 'Mi primer comentario'];
        $this->actingAs($user)->postJson(route('statuses.comments.store', $status), $comment);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'status_id' => $status->id,
            'body' => $comment['body']
        ]);
    }
}
