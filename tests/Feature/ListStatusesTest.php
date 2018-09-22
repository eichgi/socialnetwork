<?php

namespace Tests\Feature;

use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListStatusesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_get_all_statuses()
    {
        $this->withoutExceptionHandling();
        $status1 = factory('App\Status')->create(['created_at' => Carbon::now()->subDays(4)]);
        $status2 = factory('App\Status')->create(['created_at' => Carbon::now()->subDays(3)]);
        $status3 = factory('App\Status')->create(['created_at' => Carbon::now()->subDays(2)]);
        $status4 = factory('App\Status')->create(['created_at' => Carbon::now()->subDays(1)]);
        $response = $this->getJson(route('statuses.index'));
        $response->assertSuccessful();
        $response->assertJson([
            'meta' => ['total' => 4],
        ]);
        $response->assertJsonStructure([
            'data',
            'links' => ['prev', 'next'],
        ]);
        $this->assertEquals(
            $status4->body,
            $response->json('data.0.body')
        );
    }

    public function test_can_get_statuses_for_a_specific_user()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $status1 = factory(Status::class)->create(['user_id' => $user->id, 'created_at' => now()->subDay()]);
        $status2 = factory(Status::class)->create(['user_id' => $user->id]);

        $otherStatuses = factory(Status::class, 2)->create();

        $response = $this->actingAs($user)
            ->getJson(route('users.statuses.index', $user));

        $response->assertJson([
            'meta' => ['total' => 2]
        ]);

        $response->assertJsonStructure([
            'data',
            'links' => ['prev', 'next'],
        ]);

        $this->assertEquals(
            $status2->body,
            $response->json('data.0.body')
        );
    }
}
