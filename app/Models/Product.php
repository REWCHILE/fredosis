<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'technique',
        'dimensions',
        'category',
        'main_image',
        'gallery_images',
        'base_price_clp',
        'base_price_usd',
        'has_original',
        'original_sold',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'has_original' => 'boolean',
        'original_sold' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'base_price_clp' => 'decimal:2',
        'base_price_usd' => 'decimal:2',
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
