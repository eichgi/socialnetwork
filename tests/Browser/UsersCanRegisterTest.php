<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @throws \Throwable
     */
    public function test_user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'HiramGuerrero')
                ->type('first_name', 'Hiram')
                ->type('last_name', 'Guerrero')
                ->type('email', 'hiramg90@gmail.com')
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('@register-btn')
                ->assertPathIs('/')
                ->assertAuthenticated();
        });
    }

    /**
     * @throws \Throwable
     */
    public function test_user_cannot_register_with_invalid_info()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', '')
                ->press('@register-btn')
                ->assertPathIs('/register')
                ->assertPresent('@validation-errors');
        });
    }
}
