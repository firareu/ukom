<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Alat Diagnostik']);
        Category::create(['name' => 'Alat Bedah']);
        Category::create(['name' => 'Alat Laboratorium']);
        Category::create(['name' => 'Alat Terapi']);
    }
}
