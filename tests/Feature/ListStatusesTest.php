<?php

namespace Tests\Feature;

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
            'total' => 4
        ]);
        $response->assertJsonStructure([
            'data',
            'total',
            'first_page_url',
            'last_page_url'
        ]);
        $this->assertEquals(
            $status4->id,
            $response->json('data.0.id')
        );
    }
}
