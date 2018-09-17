<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function test_route_key_name_is_set_to_name()
    {
        $user = factory(User::class)->make();
        $this->assertEquals('name', $user->getRouteKeyName());
    }

    public function test_a_user_has_a_link_to_its_profile()
    {
        $user = factory(User::class)->make();
        $this->assertEquals(route('users.show', $user), $user->link());
    }

    public function test_a_user_has_an_avatar()
    {
        $user = factory(User::class)->make();
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $user->avatar());
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $user->avatar);
    }
}
