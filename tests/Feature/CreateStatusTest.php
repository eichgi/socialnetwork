<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guest_users_cannot_create_statuses()
    {
        //$this->withoutExceptionHandling();

        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer status']);
        //dd($response);
        $response->assertRedirect('login');
    }

    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function an_authenticated_user_can_create_statuses()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer status']);

        $response->assertJson([
            'data' => ['body' => 'Mi primer status']
        ]);

        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
        ]);
    }

    /**
     * @test
     */
    public function a_status_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => '']);
        //dd($response->getContent());
        //$response->assertSessionHasErrors('body');
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => ['body']
        ]);
    }

    public function test_a_status_body_requires_a_minimum_length()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'body']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => ['body']
        ]);
    }
}
