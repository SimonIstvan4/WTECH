<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['Nike', 'Jordan', 'Adidas', 'Converse', 'Vans', 'New Balance', 'Puma'];

        foreach ($brands as $brand) {
            DB::table('Brand')->insert([
                'Name' => $brand,
            ]);

        }
    }
}