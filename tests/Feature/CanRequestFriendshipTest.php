<?php

namespace Tests\Feature;

use App\Friendship;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanRequestFriendshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_users_cannot_create_friendship_requests()
    {
        $recipient = factory(User::class)->create();
        $response = $this->postJson(route('friendship.store', $recipient));
        $response->assertStatus(401);
    }

    public function test_a_user_can_create_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        $this->actingAs($sender)->postJson(route('friendship.store', $recipient));
        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending',
        ]);
    }

    public function test_guest_users_cannot_delete_friendship_requests()
    {
        $recipient = factory(User::class)->create();
        $response = $this->deleteJson(route('friendship.destroy', $recipient));
        $response->assertStatus(401);
    }

    public function test_a_user_can_accept_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending',
        ]);

        $this->actingAs($recipient)->postJson(route('accept-friendships.store', $sender));
        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'accepted',
        ]);
    }

    public function test_guest_users_cannot_accept_friendship_requests()
    {
        $user = factory(User::class)->create();
        $response = $this->postJson(route('accept-friendships.store', $user));
        $response->assertStatus(401);
    }

    public function test_a_user_can_delete_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);

        $this->actingAs($sender)->deleteJson(route('friendship.destroy', $recipient));

        $this->assertDatabaseMissing('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);
    }

    public function test_guest_users_cannot_deny_friendship_requests()
    {
        $user = factory(User::class)->create();
        $response = $this->deleteJson(route('accept-friendships.destroy', $user));
        $response->assertStatus(401);
    }

    public function test_a_user_can_deny_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending',
        ]);

        $this->actingAs($recipient)->deleteJson(route('accept-friendships.destroy', $sender));
        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'denied',
        ]);
    }
}
