<?php

namespace Tests\Feature;

use App\Status;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanLikeStatusesTest extends TestCase
{
    use RefreshDatabase;
    public $status;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->status = factory(Status::class)->create();
    }


    public function test_guest_users_cannot_like_statuses()
    {
        $response = $this->postJson(route('statuses.likes.store', $this->status));
        $response->assertStatus(401);
    }

    public function test_an_authenticated_user_can_like_unlike_statuses()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->assertCount(0, $this->status->likes);

        $this->actingAs($user)->postJson(route('statuses.likes.store', $this->status));

        $this->assertCount(1, $this->status->fresh()->likes);

        $this->assertDatabaseHas('likes', ['user_id' => $user->id,]);

        $this->actingAs($user)->deleteJson(route('statuses.likes.destroy', $this->status));

        $this->assertCount(0, $this->status->fresh()->likes);

        $this->assertDatabaseMissing('likes', ['user_id' => $user->id,]);
    }
}
