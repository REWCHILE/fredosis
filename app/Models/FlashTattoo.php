<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class FlashTattoo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image_url',
        'description',
        'price_clp',
        'price_usd',
        'size_cm',
        'recommended_zone',
        'style_id',
        'is_claimed',
        'claimed_by_name',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_claimed' => 'boolean',
        'is_active' => 'boolean',
        'price_clp' => 'decimal:2',
        'price_usd' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($flash) {
            if (empty($flash->slug)) {
                $flash->slug = Str::slug($flash->title).'-'.Str::random(5);
            }
        });
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(TattooStyle::class, 'style_id');
    }

    public function bookingRequests(): HasMany
    {
        return $this->hasMany(BookingRequest::class, 'flash_tattoo_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_active', true)->where('is_claimed', false);
    }
}
