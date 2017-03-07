<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminRolesTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
        $this->call(AdminRoleUsersTableSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(ClassroomSeeder::class);
        // $this->call(ReservationSeeder::class);
    }
}
