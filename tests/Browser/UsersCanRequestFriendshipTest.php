<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanRequestFriendshipTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @throws \Throwable
     */
    public function test_users_can_request_friendship()
    {
        $sender = factory(User::class)->create();
        $recipient = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($sender, $recipient) {
            $browser->loginAs($sender)
                ->visit(route('users.show', $recipient))
                ->press('@request-friendship')
                ->waitForText('Solicitud enviada')
                ->assertSee('Solicitud enviada');
        });
    }
}
