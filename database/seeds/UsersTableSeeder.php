<?php

use App\Status;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Status::truncate();

        factory(User::class)->create([
            'name' => 'HiramX',
            'email' => 'hiramg90@gmail.com'
        ]);
        factory(Status::class, 10)->create();
    }
}
