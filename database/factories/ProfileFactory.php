<?php

$factory->define(App\Models\Profile::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomNumber(8),
        'age' => $faker->numberBetween(1, 100),
        'gender' => $faker->boolean(),
    ];
});