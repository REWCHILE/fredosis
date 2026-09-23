<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'title',
        'slug',
        'description',
        'category',
        'medium',
        'dimensions',
        'year',
        'style_id',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function style(): BelongsTo
    {
        return $this->belongsTo(TattooStyle::class, 'style_id');
    }
}
