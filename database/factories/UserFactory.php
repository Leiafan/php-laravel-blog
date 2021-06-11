<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin',function (Faker $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => 'user',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

$factory->defineAs(App\Article::class, 'admin',function (Faker $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'text' => $faker->text,
        'views' => 0,
        'image' =>'storage/images/img1.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
