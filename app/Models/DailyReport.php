<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function usdPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }
    
    public function usdSold(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function gbpPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function gbpSold(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function eurPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function eurSold(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function aedPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function aedSold(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function nairaPurchaseValue(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function nairaSoldValue(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }
}
