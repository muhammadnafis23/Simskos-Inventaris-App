<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DATA KATEGORI
        $categoriesData = [
            'Skincare',
            'Bodycare',
            'Haircare',
            'Makeup & Cosmetics',
            'Personal Care & Hygiene',
            'Tissue & Baby Care'
        ];

        $categories = [];
        foreach ($categoriesData as $catName) {
            $categories[$catName] = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);
        }

        // 2. DATA BRAND & PRODUK
        $brandsData = [
            'Wardah' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Wardah Lightening Day Cream 30g', 'cost' => 38000, 'price' => 45000, 'stock' => 25, 'min' => 5],
                    ['name' => 'Wardah Perfect Bright Facial Wash 100ml', 'cost' => 22000, 'price' => 28000, 'stock' => 18, 'min' => 5],
                    ['name' => 'Wardah Everyday Lip Nutrition 4g', 'cost' => 20000, 'price' => 26000, 'stock' => 12, 'min' => 3],
                    ['name' => 'Wardah Exclusive Matte Lip Cream 03', 'cost' => 52000, 'price' => 62000, 'stock' => 4, 'min' => 5], // trigger low stock
                ]
            ],
            'Emina' => [
                'cat' => 'Makeup & Cosmetics',
                'products' => [
                    ['name' => 'Emina Sun Battle SPF 30 60ml', 'cost' => 25000, 'price' => 31000, 'stock' => 30, 'min' => 10],
                    ['name' => 'Emina Bright Stuff Face Wash 100ml', 'cost' => 20000, 'price' => 25000, 'stock' => 20, 'min' => 5],
                    ['name' => 'Emina Glossy Stain Lip Tint 01', 'cost' => 39000, 'price' => 47000, 'stock' => 15, 'min' => 5],
                ]
            ],
            'Kahf' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Kahf Oil and Acne Care Face Wash 100ml', 'cost' => 31000, 'price' => 38000, 'stock' => 22, 'min' => 5],
                    ['name' => 'Kahf Humbling Forest Eau de Toilette 100ml', 'cost' => 62000, 'price' => 75000, 'stock' => 10, 'min' => 3],
                    ['name' => 'Kahf Triple Protection Sunscreen Serum 31ml', 'cost' => 35000, 'price' => 42000, 'stock' => 3, 'min' => 5], // trigger low stock
                ]
            ],
            'Glad2Glow' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Glad2Glow Centella Allantoin Soothing Gel 55g', 'cost' => 35000, 'price' => 43000, 'stock' => 40, 'min' => 8],
                    ['name' => 'Glad2Glow Blueberry 5% Ceramide Moisturizer 30g', 'cost' => 36000, 'price' => 45000, 'stock' => 28, 'min' => 5],
                    ['name' => 'Glad2Glow Pomegranate 10% Niacinamide Serum', 'cost' => 38000, 'price' => 48000, 'stock' => 14, 'min' => 5],
                ]
            ],
            'Implora' => [
                'cat' => 'Makeup & Cosmetics',
                'products' => [
                    ['name' => 'Implora Urban Lip Matte Cream 01', 'cost' => 16000, 'price' => 21000, 'stock' => 50, 'min' => 10],
                    ['name' => 'Implora Eyebrow Pencil Brown', 'cost' => 6000, 'price' => 9000, 'stock' => 60, 'min' => 15],
                    ['name' => 'Implora Serum Acne Care 20ml', 'cost' => 28000, 'price' => 35000, 'stock' => 12, 'min' => 5],
                ]
            ],
            'Hanasui' => [
                'cat' => 'Makeup & Cosmetics',
                'products' => [
                    ['name' => 'Hanasui Serum Cushion Light 01', 'cost' => 55000, 'price' => 68000, 'stock' => 15, 'min' => 5],
                    ['name' => 'Hanasui Power Bright Serum 20ml', 'cost' => 21000, 'price' => 27000, 'stock' => 25, 'min' => 5],
                    ['name' => 'Hanasui Mattedorable Lip Cream 01', 'cost' => 18000, 'price' => 24000, 'stock' => 35, 'min' => 10],
                ]
            ],
            'Skintific' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Skintific 5X Ceramide Barrier Moisture Gel 30g', 'cost' => 110000, 'price' => 135000, 'stock' => 18, 'min' => 5],
                    ['name' => 'Skintific Mugwort Acne Clay Stick 40g', 'cost' => 75000, 'price' => 89000, 'stock' => 22, 'min' => 5],
                    ['name' => 'Skintific All Day Light Sunscreen Mist 50ml', 'cost' => 72000, 'price' => 86000, 'stock' => 2, 'min' => 5], // trigger low stock
                ]
            ],
            'Scarlett' => [
                'cat' => 'Bodycare',
                'products' => [
                    ['name' => 'Scarlett Whitening Body Lotion Jolly 300ml', 'cost' => 60000, 'price' => 72000, 'stock' => 30, 'min' => 5],
                    ['name' => 'Scarlett Whitening Shower Scrub Pomegranate', 'cost' => 60000, 'price' => 72000, 'stock' => 24, 'min' => 5],
                    ['name' => 'Scarlett Herbalism Artemisia Essence Toner', 'cost' => 62000, 'price' => 75000, 'stock' => 11, 'min' => 3],
                ]
            ],
            'Scora' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Scora 5% Niacinamide Hydramoist Gel 100ml', 'cost' => 45000, 'price' => 58000, 'stock' => 35, 'min' => 5],
                    ['name' => 'Scora Salicylic Acid Gentle Cleansing Gel 100ml', 'cost' => 42000, 'price' => 54000, 'stock' => 20, 'min' => 5],
                ]
            ],
            'OMG' => [
                'cat' => 'Makeup & Cosmetics',
                'products' => [
                    ['name' => 'OMG Oh My Glam Matte Kiss Lip Cream 12', 'cost' => 15000, 'price' => 19000, 'stock' => 45, 'min' => 10],
                    ['name' => 'OMG Oh My Glow Peach Glowing Face Wash 50g', 'cost' => 11000, 'price' => 15000, 'stock' => 30, 'min' => 5],
                ]
            ],
            'Pigeon' => [
                'cat' => 'Tissue & Baby Care',
                'products' => [
                    ['name' => 'Pigeon Teens Powder Squeeze White 20g', 'cost' => 22000, 'price' => 28000, 'stock' => 18, 'min' => 5],
                    ['name' => 'Pigeon Baby Compact Powder Hypoallergenic', 'cost' => 33000, 'price' => 41000, 'stock' => 14, 'min' => 3],
                ]
            ],
            'Facetology' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Facetology Triple Care Sunscreen SPF 40 40ml', 'cost' => 62000, 'price' => 78000, 'stock' => 25, 'min' => 5],
                    ['name' => 'Facetology Triple Care Facial Gel Cleanser 100ml', 'cost' => 45000, 'price' => 56000, 'stock' => 19, 'min' => 5],
                ]
            ],
            'Originote' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'The Originote Hyalucera Moisturizer 50ml', 'cost' => 32000, 'price' => 42000, 'stock' => 50, 'min' => 10],
                    ['name' => 'The Originote Cica-B5 Soothing Moisturizer 50ml', 'cost' => 32000, 'price' => 42000, 'stock' => 38, 'min' => 8],
                    ['name' => 'The Originote Eye Serum 15ml', 'cost' => 28000, 'price' => 36000, 'stock' => 21, 'min' => 5],
                ]
            ],
            'Pixy' => [
                'cat' => 'Makeup & Cosmetics',
                'products' => [
                    ['name' => 'Pixy UV Whitening Two Way Cake Perfect Fit', 'cost' => 32000, 'price' => 40000, 'stock' => 20, 'min' => 5],
                    ['name' => 'Pixy Make It Glow Dewy Cushion 101', 'cost' => 85000, 'price' => 105000, 'stock' => 8, 'min' => 3],
                ]
            ],
            'Ponds' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Ponds Bright Beauty Facial Foam 100g', 'cost' => 26000, 'price' => 33000, 'stock' => 28, 'min' => 5],
                    ['name' => 'Ponds Age Miracle Day Cream 50g', 'cost' => 115000, 'price' => 138000, 'stock' => 7, 'min' => 3],
                ]
            ],
            'Garnier' => [
                'cat' => 'Skincare',
                'products' => [
                    ['name' => 'Garnier Micellar Cleansing Water Pink 125ml', 'cost' => 28000, 'price' => 35000, 'stock' => 32, 'min' => 5],
                    ['name' => 'Garnier Bright Complete Vitamin C Serum 30ml', 'cost' => 82000, 'price' => 99000, 'stock' => 14, 'min' => 4],
                ]
            ],
            'Herborist' => [
                'cat' => 'Bodycare',
                'products' => [
                    ['name' => 'Herborist Minyak Zaitun 150ml', 'cost' => 21000, 'price' => 27000, 'stock' => 40, 'min' => 8],
                    ['name' => 'Herborist Body Butter Mango 80g', 'cost' => 18000, 'price' => 23000, 'stock' => 16, 'min' => 5],
                ]
            ],
            'Vaseline' => [
                'cat' => 'Bodycare',
                'products' => [
                    ['name' => 'Vaseline Healthy Bright Gluta-Hya Lotion 200ml', 'cost' => 38000, 'price' => 47000, 'stock' => 35, 'min' => 8],
                    ['name' => 'Vaseline Petroleum Jelly Original 50ml', 'cost' => 22000, 'price' => 28000, 'stock' => 42, 'min' => 10],
                ]
            ],
            'Nivea' => [
                'cat' => 'Bodycare',
                'products' => [
                    ['name' => 'Nivea Extra Bright Body Serum 180ml', 'cost' => 35000, 'price' => 43000, 'stock' => 26, 'min' => 5],
                    ['name' => 'Nivea Lip Care Essential Care 4.8g', 'cost' => 17000, 'price' => 22000, 'stock' => 19, 'min' => 5],
                ]
            ],
            'Emeron' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Emeron Shampoo Hair Fall Control 170ml', 'cost' => 14000, 'price' => 18000, 'stock' => 30, 'min' => 5],
                    ['name' => 'Emeron Hair Vitamin Black & Shine 6 Capsule', 'cost' => 7000, 'price' => 10000, 'stock' => 50, 'min' => 10],
                ]
            ],
            'Lavojoy' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Lavojoy Hold Me Tight Shampoo Lazy Sunday 280ml', 'cost' => 88000, 'price' => 109000, 'stock' => 12, 'min' => 3],
                    ['name' => 'Lavojoy SOS Nourishing Conditioner 300ml', 'cost' => 88000, 'price' => 109000, 'stock' => 9, 'min' => 3],
                ]
            ],
            'Pantene' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Pantene Shampoo Hair Fall Control 290ml', 'cost' => 38000, 'price' => 46000, 'stock' => 22, 'min' => 5],
                    ['name' => 'Pantene 3 Minute Miracle Conditioner 150ml', 'cost' => 26000, 'price' => 33000, 'stock' => 18, 'min' => 5],
                ]
            ],
            'Sunsilk' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Sunsilk Black Shine Shampoo 160ml', 'cost' => 18000, 'price' => 23000, 'stock' => 35, 'min' => 5],
                    ['name' => 'Sunsilk Soft & Smooth Shampoo 320ml', 'cost' => 32000, 'price' => 40000, 'stock' => 17, 'min' => 5],
                ]
            ],
            'Lifebuoy' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Lifebuoy Sabun Mandi Cair Total 10 Refill 400ml', 'cost' => 21000, 'price' => 27000, 'stock' => 45, 'min' => 10],
                    ['name' => 'Lifebuoy Hand Wash Total 10 Pump 200ml', 'cost' => 16000, 'price' => 21000, 'stock' => 28, 'min' => 5],
                ]
            ],
            'Head & Shoulders' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Head & Shoulders Shampoo Cool Menthol 160ml', 'cost' => 24000, 'price' => 30000, 'stock' => 24, 'min' => 5],
                    ['name' => 'Head & Shoulders Shampoo Lemon Fresh 300ml', 'cost' => 42000, 'price' => 52000, 'stock' => 13, 'min' => 4],
                ]
            ],
            'Zinc' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Zinc Shampoo Anti Dandruff Cool Menthol 170ml', 'cost' => 15000, 'price' => 19000, 'stock' => 30, 'min' => 5],
                    ['name' => 'Zinc Shampoo Refreshing Cool 340ml', 'cost' => 28000, 'price' => 35000, 'stock' => 20, 'min' => 5],
                ]
            ],
            'Tressemme' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'TRESemme Keratin Smooth Shampoo 170ml', 'cost' => 28000, 'price' => 35000, 'stock' => 21, 'min' => 5],
                    ['name' => 'TRESemme Hair Fall Control Shampoo 340ml', 'cost' => 49000, 'price' => 60000, 'stock' => 11, 'min' => 3],
                ]
            ],
            'Dove' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Dove Beauty Body Wash Deep Moisture 400ml', 'cost' => 31000, 'price' => 39000, 'stock' => 25, 'min' => 5],
                    ['name' => 'Dove Original Deodorant Roll On 40ml', 'cost' => 18000, 'price' => 23000, 'stock' => 30, 'min' => 5],
                ]
            ],
            'Rejoice' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Rejoice Shampoo Rich Soft Smooth 150ml', 'cost' => 16000, 'price' => 20000, 'stock' => 28, 'min' => 5],
                    ['name' => 'Rejoice Shampoo 3 in 1 Anti Dandruff 340ml', 'cost' => 34000, 'price' => 42000, 'stock' => 15, 'min' => 5],
                ]
            ],
            'Shinzui' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Shinzu\'i Body Wash Matsu Refill 400ml', 'cost' => 22000, 'price' => 28000, 'stock' => 40, 'min' => 10],
                    ['name' => 'Shinzu\'i Body Scrub Kirei 250g', 'cost' => 16000, 'price' => 21000, 'stock' => 33, 'min' => 5],
                ]
            ],
            'Biore' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Biore Guard Body Wash Healthy Plus 450ml', 'cost' => 24000, 'price' => 30000, 'stock' => 38, 'min' => 8],
                    ['name' => 'Biore UV Aqua Rich Watery Essence SPF 50', 'cost' => 92000, 'price' => 115000, 'stock' => 12, 'min' => 4],
                ]
            ],
            'Detol' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Dettol Body Wash Original Refill 410g', 'cost' => 26000, 'price' => 33000, 'stock' => 35, 'min' => 8],
                    ['name' => 'Dettol Antiseptic Liquid 95ml', 'cost' => 21000, 'price' => 27000, 'stock' => 20, 'min' => 5],
                ]
            ],
            'Paseo' => [
                'cat' => 'Tissue & Baby Care',
                'products' => [
                    ['name' => 'Paseo Tissue Facial Soft Pack 250 Sheets', 'cost' => 14000, 'price' => 18000, 'stock' => 60, 'min' => 15],
                    ['name' => 'Paseo Tissue Basah Anti Bacterial 50s', 'cost' => 12000, 'price' => 16000, 'stock' => 45, 'min' => 10],
                ]
            ],
            'Jolly' => [
                'cat' => 'Tissue & Baby Care',
                'products' => [
                    ['name' => 'Jolly Tissue Kulit Wajah 250 Sheets', 'cost' => 8000, 'price' => 11000, 'stock' => 80, 'min' => 20],
                ]
            ],
            'Natur E' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Natur-E 100 IU Vitamin E 16 Kapsul', 'cost' => 18000, 'price' => 23000, 'stock' => 25, 'min' => 5],
                    ['name' => 'Natur-E Daily Nourishing Body Lotion 245ml', 'cost' => 27000, 'price' => 34000, 'stock' => 18, 'min' => 5],
                ]
            ],
            'Gatsby' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Gatsby Styling Wax Harajuku Volume 75g', 'cost' => 28000, 'price' => 35000, 'stock' => 22, 'min' => 5],
                    ['name' => 'Gatsby Body Roll On Deodorant Cool 50ml', 'cost' => 14000, 'price' => 18000, 'stock' => 30, 'min' => 5],
                ]
            ],
            'Makarizo' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Makarizo Hair Energy Scentsations 100ml', 'cost' => 26000, 'price' => 33000, 'stock' => 27, 'min' => 5],
                    ['name' => 'Makarizo Hair Repair Mask Royal Jelly 45g', 'cost' => 12000, 'price' => 16000, 'stock' => 40, 'min' => 10],
                ]
            ],
            'Barber Daily' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Barber Daily Waterbased Pomade 80g', 'cost' => 45000, 'price' => 58000, 'stock' => 15, 'min' => 3],
                ]
            ],
            'Pepsodent' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Pepsodent Pasta Gigi Complete 8 Herbal 190g', 'cost' => 16000, 'price' => 20000, 'stock' => 50, 'min' => 10],
                    ['name' => 'Pepsodent Sikat Gigi Double Care Sensitive', 'cost' => 12000, 'price' => 16000, 'stock' => 35, 'min' => 5],
                ]
            ],
            'Listerine' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Listerine Cool Mint Mouthwash 250ml', 'cost' => 21000, 'price' => 26000, 'stock' => 24, 'min' => 5],
                    ['name' => 'Listerine Zero Alcohol Mouthwash 500ml', 'cost' => 38000, 'price' => 47000, 'stock' => 16, 'min' => 4],
                ]
            ],
            'Sensodyne' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Sensodyne Pasta Gigi Fresh Mint 100g', 'cost' => 28000, 'price' => 35000, 'stock' => 30, 'min' => 5],
                    ['name' => 'Sensodyne Pasta Gigi Repair & Protect 100g', 'cost' => 38000, 'price' => 46000, 'stock' => 22, 'min' => 5],
                ]
            ],
            'Close Up' => [
                'cat' => 'Personal Care & Hygiene',
                'products' => [
                    ['name' => 'Close Up Gel Toothpaste Ever Fresh 160g', 'cost' => 15000, 'price' => 19000, 'stock' => 35, 'min' => 8],
                ]
            ],
            'Clear' => [
                'cat' => 'Haircare',
                'products' => [
                    ['name' => 'Clear Shampoo Ice Cool Menthol 160ml', 'cost' => 22000, 'price' => 28000, 'stock' => 32, 'min' => 5],
                    ['name' => 'Clear Men Shampoo Complete Care 300ml', 'cost' => 40000, 'price' => 50000, 'stock' => 14, 'min' => 4],
                ]
            ],
        ];

        // 3. GENERATE DATABASE
        $skuCounter = 101;
        foreach ($brandsData as $brandName => $data) {
            $brand = Brand::create([
                'name' => $brandName,
                'slug' => Str::slug($brandName),
                'image' => 'brands/default.png', // Default image
            ]);

            $categoryId = $categories[$data['cat']]->id;

            foreach ($data['products'] as $prod) {
                Product::create([
                    'category_id'    => $categoryId,
                    'brand_id'       => $brand->id,
                    'sku'            => 'SKU-' . $skuCounter++,
                    'name'           => $prod['name'],
                    'purchase_price' => $prod['cost'],
                    'selling_price'  => $prod['price'],
                    'stock'          => $prod['stock'],
                    'min_stock'      => $prod['min'],
                ]);
            }
        }
    }
}