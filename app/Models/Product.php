<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'sku',
        'name',
        'purchase_price',
        'selling_price', // <-- Gunakan 'selling_price' sesuai nama kolom DB
        'stock',
        'min_stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function isLowStock(): bool
    {
        return $this->stock <= $this->min_stock;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}