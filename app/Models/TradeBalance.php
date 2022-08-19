<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradeBalance extends Model
{
    use HasFactory;

    /**
     * Attributes not fillable
     * 
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Relationship to return with
     */
    protected $with = ['currency'];

    // public function openingBalance(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => number_format($value)
    //     );
    // }

    // public function closingBalance(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => number_format($value)
    //     );
    // }

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

    /**
     * currency relationship
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
