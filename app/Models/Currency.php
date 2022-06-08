<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }

    public function code(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value)
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toDateTimeString()
        );
    }
}
