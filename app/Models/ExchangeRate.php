<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['currency'];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toDateTimeString()
        );
    }

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toDateTimeString()
        );
    }
}
