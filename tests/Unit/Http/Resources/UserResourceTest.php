<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use App\Status;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_resources_must_have_the_necessary_fields()
    {
        $user = factory(User::class)->create();
        $userResource = UserResource::make($user)->resolve();

        $this->assertEquals($user->name, $userResource['name']);
        $this->assertEquals($user->link(), $userResource['link']);
        $this->assertEquals($user->avatar(), $userResource['avatar']);
    }
}
