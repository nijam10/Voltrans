<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Mobil Listrik',
                'slug' => 'mobil-listrik',
                'image' => 'categories/category-car.jpg',
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Motor Listrik',
                'slug' => 'motor-listrik',
                'image' => 'categories/category-motorcycle.jpg',
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Skuter Listrik',
                'slug' => 'skuter-listrik',
                'image' => 'categories/category-scooter.jpg',
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
