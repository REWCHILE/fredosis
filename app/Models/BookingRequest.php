<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'flash_tattoo_id',
        'description',
        'size',
        'body_zone',
        'preferred_date',
        'preferred_time_slot',
        'budget',
        'location',
        'references',
        'status',
    ];

    protected $casts = [
        'preferred_date' => 'datetime',
        'references' => 'array',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function flashTattoo(): BelongsTo
    {
        return $this->belongsTo(FlashTattoo::class, 'flash_tattoo_id');
    }

    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class);
    }
}
