<?php

use App\Status;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create();
        },
        'body' => $faker->paragraph,
        'status_id' => function () {
            return factory(Status::class)->create();
        }
    ];
});
