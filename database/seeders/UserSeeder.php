<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('admin_setup.email');
        $jelszo = config('admin_setup.password');
        if ($email && $jelszo) {
            $letezik = DB::table('users')->where('email', $email)->exists();

            if (! $letezik) {
                DB::table('users')->insert([
                    'name' => 'admin',
                    'email' => $email,
                    'password' => Hash::make($jelszo),
                    'role' => 1,
                ]);
            }
        }
    }
}