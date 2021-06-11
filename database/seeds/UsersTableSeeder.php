<?php

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
        factory(App\User::class, 'admin', 100)->create()->each(function ($user) {
            $user->article()->save(factory(App\Article::class, 'admin')->make());
        });
    }
}
