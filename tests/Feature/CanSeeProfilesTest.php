<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanSeeProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_profiles_test()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create(['name' => 'Hiram']);

        $this->get('@Hiram')->assertSee('Hiram');
    }
}
