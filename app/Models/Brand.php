<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'image'];

    /**
     * Relasi One-to-Many ke model Product
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}