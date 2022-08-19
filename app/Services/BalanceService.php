<?php

namespace App\Services;

use App\Models\DailyReport;

class BalanceService
{
    /**
     * Get current USD trading balance
     */
    public function getUsdTradingBalance($date)
    {
        return DailyReport::where('created_at', 'like', $date . '%')
            ->pluck('usd_bal')
            ->first();
    }

    /**
     * Get current GBP trading balance
     */
    public function getGbpTradingBalance($date)
    {
        return DailyReport::where('created_at', 'like', $date . '%')
            ->pluck('gbp_bal')
            ->first();
    }

    /**
     * Get current EUR trading balance
     */
    public function getEurTradingBalance($date)
    {
        return DailyReport::where('created_at', 'like', $date . '%')
            ->pluck('eur_bal')
            ->first();
    }

    /**
     * Get current AED trading balance
     */
    public function getAedTradingBalance($date)
    {
        return DailyReport::where('created_at', 'like', $date . '%')
            ->pluck('aed_bal')
            ->first();
    }

    /**
     * Get current USD trading balance
     */
    public function getNgnTradingBalance($date)
    {
        return DailyReport::where('created_at', 'like', $date . '%')
            ->pluck('naira_bal')
            ->first();
    }
}
