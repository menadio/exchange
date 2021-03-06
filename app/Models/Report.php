<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function totalUsdPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalUsdSold(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalGbpPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalGbpSold(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalEurPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalEurSold(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalAedPurchased(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalAedSold(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalNairaPurchaseValue(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    public function totalNairaSoldValue(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }
}
