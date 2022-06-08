<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyService
{
    /**
     * Return currency code
     * 
     * @return \Illuminate\Http\Response
     */
    public function getCurrencyCode($id): string
    {
        return Currency::where('id', $id)
            ->pluck('code')
            ->first();
    }
}