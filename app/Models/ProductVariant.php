<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'format_name',
        'format_type',
        'price_usd',
        'price_clp',
        'price_eur',
        'price_mxn',
        'stock',
        'is_available',
    ];

    protected $casts = [
        'price_usd' => 'decimal:2',
        'price_clp' => 'decimal:2',
        'price_eur' => 'decimal:2',
        'price_mxn' => 'decimal:2',
        'stock' => 'integer',
        'is_available' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceForCurrency(string $currency): float
    {
        return match (strtoupper($currency)) {
            'CLP' => (float) $this->price_clp,
            'EUR' => (float) $this->price_eur,
            'MXN' => (float) $this->price_mxn,
            default => (float) $this->price_usd,
        };
    }
}
