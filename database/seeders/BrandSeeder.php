<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Wardah', 'image' => 'brands/default.png'],
            ['name' => 'Somethinc', 'image' => 'brands/default.png'],
            ['name' => 'Skintific', 'image' => 'brands/default.png'],
            ['name' => 'Emina', 'image' => 'brands/default.png'],
            ['name' => 'Maybelline', 'image' => 'brands/default.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}