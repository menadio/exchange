<?php

namespace App\Services;

use App\Models\TradeType;

class TradeTypeService
{
    public function getType(int $type): string
    {
        return TradeType::where('id', $type)
            ->pluck('name')
            ->first();
    }
}