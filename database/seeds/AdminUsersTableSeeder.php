<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_users')->truncate();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'name' => '管理员-xiyusullos',
                'avatar' => 'image/avatar.jpg',
                'remember_token' => null,
                'created_at' => null,
                'updated_at' => null,
            )
        ));
        
        
    }
}