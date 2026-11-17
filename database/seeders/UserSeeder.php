<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User1', 
            'email' => 'aaa@aaa.hu', 
            'password' => bcrypt('aaaaaaaa'), 
            'role' => 2,
        ]);
        DB::table('users')->insert([
            'name' => 'admin', 
            'email' => 'bbb@bbb', 
            'password' => bcrypt('bbbbbbbb'), 
            'role' => 1, 
        ]);
    }
}
