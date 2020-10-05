<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'zip_code' => $faker->postcode,
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'neighborhood' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'user_id' => $faker->unique(true)->numberBetween($min = 1, $max =10),
    ];
});
