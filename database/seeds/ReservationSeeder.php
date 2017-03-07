<?php

use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('reservations')->truncate();

        $faker = Faker\Factory::create();

        $count = 30;
        factory(\App\Models\Reservation::class, $count)->create([
            'user_id' => 1,
            'classroom_id' => $faker->unique()->numberBetween(1,100),
        ]);
        factory(\App\Models\Reservation::class, $count)->create([
            'user_id' => $faker->unique()->numberBetween(1,100),
            'classroom_id' => 1,
        ]);
        factory(\App\Models\Reservation::class, $count)->create([
            // 'user_id' => $faker->unique()->numberBetween(1,100),
            // 'classroom_id' => 1,
        ]);

    }
}
