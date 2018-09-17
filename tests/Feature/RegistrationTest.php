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
        $this->get(route('register'))->assertSuccessful();

        $response = $this->post(route('register'), $this->userValidData());

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'ChatoPato123',
            'first_name' => 'Chato',
            'last_name' => 'Pato',
            'email' => 'chatosopatoso@gmail.com',
        ]);

        $this->assertTrue(Hash::check('secret', User::first()->password));
    }

    public function test_the_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => null])
        )->assertSessionHasErrors('name');
    }

    public function test_the_name_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => 1234])
        )->assertSessionHasErrors('name');
    }

    public function test_the_name_may_not_be_greater_than_255_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => str_random(256)])
        )->assertSessionHasErrors('name');
    }

    public function test_the_name_must_be_unique()
    {
        factory(User::class)->create(['name' => 'HiramGuerrero']);
        $this->post(
            route('register'),
            $this->userValidData(['name' => 'HiramGuerrero'])
        )->assertSessionHasErrors('name');
    }

    public function test_the_name_may_only_contain_letters_and_numbers()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => 'Hiram Guerrero'])
        )->assertSessionHasErrors('name');

        $this->post(
            route('register'),
            $this->userValidData(['name' => 'Hiram Guerrero123'])
        )->assertSessionHasErrors('name');
    }

    public function test_the_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => str_random(2)])
        )->assertSessionHasErrors('name');
    }

    public function test_the_first_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => null])
        )->assertSessionHasErrors('first_name');
    }

    public function test_the_first_name_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => 1234])
        )->assertSessionHasErrors('first_name');
    }

    public function test_the_first_name_may_not_be_greater_than_255_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => str_random(256)])
        )->assertSessionHasErrors('first_name');
    }

    public function test_the_first_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => str_random(2)])
        )->assertSessionHasErrors('first_name');
    }

    public function test_the_first_name_may_only_contain_letters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => 'Hiram Guerrero123'])
        )->assertSessionHasErrors('first_name');
    }

    public function test_the_last_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => null])
        )->assertSessionHasErrors('last_name');
    }

    public function test_the_last_name_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => 1234])
        )->assertSessionHasErrors('last_name');
    }

    public function test_the_last_name_may_not_be_greater_than_255_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => str_random(256)])
        )->assertSessionHasErrors('last_name');
    }

    public function test_the_last_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => str_random(2)])
        )->assertSessionHasErrors('last_name');
    }

    public function test_the_last_name_may_only_contain_letters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => 'Hiram Guerrero123'])
        )->assertSessionHasErrors('last_name');
    }

    public function test_the_email_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['email' => null])
        )->assertSessionHasErrors('email');
    }

    public function test_the_email_must_be_a_valid_email_address()
    {
        $this->post(
            route('register'),
            $this->userValidData(['email' => 'invalid@email'])
        )->assertSessionHasErrors('email');
    }

    public function test_the_email_must_be_unique()
    {
        factory(User::class)->create(['email' => 'hiramg90@gmail.com']);
        $this->post(
            route('register'),
            $this->userValidData(['email' => 'hiramg90@gmail.com'])
        )->assertSessionHasErrors('email');
    }

    public function test_the_password_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['password' => null])
        )->assertSessionHasErrors('password');
    }

    public function test_the_password_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['password' => 1234])
        )->assertSessionHasErrors('password');
    }

    public function test_the_password_must_be_at_least_6_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['password' => str_random(5)])
        )->assertSessionHasErrors('password');
    }

    public function test_the_password_must_be_confirmed()
    {
        $this->post(
            route('register'),
            $this->userValidData(['password' => 'secret', 'password_confirmation' => 'secreto'])
        )->assertSessionHasErrors('password');
    }

    /**
     * @param array $overrides
     * @return array
     */
    public function userValidData($overrides = []): array
    {
        return array_merge([
            'name' => 'ChatoPato123',
            'first_name' => 'Chato',
            'last_name' => 'Pato',
            'email' => 'chatosopatoso@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ], $overrides);
    }
}
