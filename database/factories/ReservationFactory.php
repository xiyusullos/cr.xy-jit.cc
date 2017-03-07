<?php

$factory->define(App\Models\Reservation::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
             return factory(App\Models\User::class)->create()->id;
        },
        'classroom_id' => function () {
             return factory(App\Models\Classroom::class)->create()->id;
        },
        'begin_time' => $faker->dateTimeBetween('-1days', 'now'),
        'end_time' => $faker->dateTimeBetween('now', '+1days'),
    ];
});