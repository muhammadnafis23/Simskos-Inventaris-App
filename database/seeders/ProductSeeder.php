<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['category' => 'Skincare', 'brand' => 'Wardah', 'sku' => 'SK-001', 'name' => 'Wardah Lightening Serum 20ml', 'purchase_price' => 18000, 'sale_price' => 25000, 'stock' => 30, 'min_stock' => 10],
            // salin baris berikutnya dari Excel kamu di sini dengan format yang sama
        ];

        foreach ($data as $item) {
            $category = Category::firstOrCreate(['name' => $item['category']]);
            Product::create([
                'category_id' => $category->id,
                'sku' => $item['sku'],
                'brand' => $item['brand'],
                'name' => $item['name'],
                'purchase_price' => $item['purchase_price'],
                'sale_price' => $item['sale_price'],
                'stock' => $item['stock'],
                'min_stock' => $item['min_stock'],
            ]);
        }
    }
}