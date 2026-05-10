<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['ŽENY', 'MUŽI', 'DETI', 'UNISEX'];

        foreach ($categories as $category) {
            DB::table('Category')->insert([
                'Name' => $category,
            ]);
        }
    }
    
}