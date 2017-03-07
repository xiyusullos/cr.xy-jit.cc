<?php

use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('classrooms')->truncate();

        factory(\App\Models\Classroom::class, 100)->create();
    }
}
