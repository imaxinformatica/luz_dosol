<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('luzsol2020'), // secret
        'cellphone' => $faker->cellphone,
        'cpf' => $faker->cpf,
        'rg' => $faker->rg,
        'status' => 0,
        'remember_token' => str_random(10),
        'user_id' => 1
    ];
});
