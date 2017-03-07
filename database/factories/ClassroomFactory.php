<?php

$factory->define(App\Models\Classroom::class, function (Faker\Generator $faker) {
    return [
        'number' => $faker->unique()->regexify('[0-9]{4}'),
        'name' => $faker->word,
        'location' => $faker->randomElement(['南区', '北区'])
            .$faker->numberBetween(1, 9) .'号楼',
        'square' => $faker->randomFloat(2, 30, 100),
        'floor' => $faker->numberBetween(1, 5),
        'is_free' => 1,
        'building_name' => '教学楼',
    ];
});