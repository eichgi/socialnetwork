<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     * @test
     */
    public function registered_users_can_login()
    {
        factory(User::class)->create([
            'email' => 'hiramg90@gmail.com'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'hiramg90@gmail.com')
                ->type('password', 'secret')
                ->press('@login-btn')
                ->assertPathIs('/')
                ->assertAuthenticated();
        });
    }

    /**
     * @throws \Throwable
     */
    public function test_user_cannot_login_with_invalid_info()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', '')
                ->press('@login-btn')
                ->assertPathIs('/login')
                ->assertPresent('@validation-errors');
        });
    }
}
