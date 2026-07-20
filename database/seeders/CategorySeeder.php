<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Skincare','Makeup','Perawatan Tubuh','Haircare','Sabun/Mandi','Rumah Tangga','Oral Care','Lainnya'];
        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}