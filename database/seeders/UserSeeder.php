<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('User')->insert([
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'admin' => true,
            ],
            [
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('123'),
                'admin' => true,
            ]
        ]);
    }
}