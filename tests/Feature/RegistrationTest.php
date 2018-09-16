<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_register()
    {
        //$this->withoutExceptionHandling();

        $userData = [
            'name' => 'ChatoPato',
            'first_name' => 'Chato',
            'last_name' => 'Pato',
            'email' => 'chatosopatoso@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'ChatoPato',
            'first_name' => 'Chato',
            'last_name' => 'Pato',
            'email' => 'chatosopatoso@gmail.com',
        ]);

        $this->assertTrue(Hash::check('secret', User::first()->password));
    }
}
