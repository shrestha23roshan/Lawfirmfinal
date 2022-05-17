<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            [
                'parent_id' => '0',
                'module_name' => 'User Management',
                'slug' => 'admin.privilege',
                'menu-class' => 'privilege',
                'icon' => 'fa fa-cog',
                'order_position' => '0',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '1',
                'module_name' => 'Role',
                'slug' => 'admin.privilege.role',
                'menu-class' => 'role',
                'icon' => 'fa fa-users',
                'order_position' => '1',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '1',
                'module_name' => 'User',
                'slug' => 'admin.privilege.user',
                'menu-class' => 'user',
                'icon' => 'fa fa-user',
                'order_position' => '2',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'About',
                'slug' => 'admin.about',
                'menu-class' => 'about',
                'icon' => 'fa fa-file-image-o',
                'order_position' => '1',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'Services',
                'slug' => 'admin.services',
                'menu-class' => 'services',
                'icon' => 'fa fa-briefcase',
                'order_position' => '2',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'News',
                'slug' => 'admin.news',
                'menu-class' => 'news',
                'icon' => 'fa fa-newspaper-o',
                'order_position' => '3',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'Resources',
                'slug' => 'admin.resources',
                'menu-class' => 'resources',
                'icon' => 'fa fa-file',
                'order_position' => '4',
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
