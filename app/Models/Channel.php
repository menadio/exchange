<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value)
        );
    }
}
