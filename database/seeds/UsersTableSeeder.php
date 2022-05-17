<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'username' => 'nyatapol',
                'password' => bcrypt('ny@t@p0l#987'),
                'full_name' => 'Nyatapol',
                'designation' => 'Developer',
                'is_active' => '1',
                'image_icon' => null,
                'remember_token' => str_random(60),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'username' => 'lawfirmfinal',
                'password' => bcrypt('lawfirmfinal@5678'),
                'full_name' => 'Lawfirmfinal',
                'designation' => 'Admin',
                'is_active' => '1',
                'image_icon' => null,
                'remember_token' => str_random(60),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
