<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->truncate();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => '教室管理',
                'icon' => 'fa-bars',
                'uri' => 'classrooms',
                'created_at' => null,
                'updated_at' => null,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 2,
                'title' => '教室租赁',
                'icon' => 'fa-bars',
                'uri' => 'reservations',
                'created_at' => null,
                'updated_at' => null,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 0,
                'order' => 3,
                'title' => '管理员设置',
                'icon' => 'fa-gear',
                'uri' => '',
                'created_at' => null,
                'updated_at' => null,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 3,
                'order' => 1,
                'title' => '管理员',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'created_at' => null,
                'updated_at' => null,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 3,
                'order' => 2,
                'title' => '角色',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'created_at' => null,
                'updated_at' => null,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 3,
                'order' => 3,
                'title' => '权限',
                'icon' => 'fa-user',
                'uri' => 'auth/permissions',
                'created_at' => null,
                'updated_at' => null,
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 3,
                'order' => 4,
                'title' => '菜单',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'created_at' => null,
                'updated_at' => null,
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 3,
                'order' => 5,
                'title' => '操作日志',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'created_at' => null,
                'updated_at' => null,
            ),
        ));
        
        
    }
}