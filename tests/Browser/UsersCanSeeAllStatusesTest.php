<?php

namespace Tests\Browser;

use App\Status;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanSeeAllStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     * @throws \Throwable
     */
    public function test_users_can_see_all_statuses_on_the_homepage()
    {
        $statuses = factory(Status::class, 3)->create();

        $this->browse(function (Browser $browser) use ($statuses) {
            $browser->visit('/')
                ->waitForText($statuses->first()->body)
                ->assertSee($statuses->first()->body);

            foreach ($statuses as $status) {
                $browser->assertSee($status->body)
                ->assertSee($status->user->name)
                //->assertSee($status->created_at->diffForHumans());
                ->assertSee($status->created_at);
            }
        });
    }
}
