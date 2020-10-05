<?php

use Faker\Generator as Faker;

$factory->define(App\Databank::class, function (Faker $faker) {
    return [
        'bank_code' => $faker->numberBetween($min = 1000000, $max =9999999),
        'agency' => $faker->numberBetween($min = 1000, $max =9999),
        'account' => $faker->numberBetween($min = 1000, $max =9999),
        'account_type' => $faker->numberBetween($min = 1000, $max =9999),
        'cpf_holder' => $faker->cpf,
        'name_holder' => $faker->name,
        'type_account' => 1,
        'user_id' => $faker->unique(true)->numberBetween($min = 1, $max =10),
    ];
});
