<?php

$factory->define(App\Models\Code::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'code' => $faker->regexify('[0-9]{6}'),
        'expiration' => 120,
    ];
});