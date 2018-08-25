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

        //1.- Given => Teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        //2.- When => Cuando hace un post request a status
        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer status']);

        $response->assertJson([
            'body' => 'Mi primer status'
        ]);

        //3.- Then => Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
        ]);
    }
}
