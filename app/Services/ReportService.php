<?php

namespace App\Services;

use App\Models\DailyReport;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportService
{
    /**
     * gets collection of reports
     */
    public function getReports($period)
    {
        return DailyReport::where('created_at', 'like', $period.'%')
            ->orderBy('date', 'desc')
            ->paginate(20);
    }

    public function getUsdPurchased($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 1)
            ->where('trade_type_id', 1)
            ->sum('amount');
    }

    public function getUsdSold($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 1)
            ->where('trade_type_id', 2)
            ->sum('amount');
    }

    public function getGbpPurchased($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 2)
            ->where('trade_type_id', 1)
            ->sum('amount');
    }

    public function getGbpSold($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 2)
            ->where('trade_type_id', 2)
            ->sum('amount');
    }

    public function getEurPurchased($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 3)
            ->where('trade_type_id', 1)
            ->sum('amount');
    }

    public function getEurSold($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 3)
            ->where('trade_type_id', 2)
            ->sum('amount');
    }

    public function getAedPurchased($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 4)
            ->where('trade_type_id', 1)
            ->sum('amount');
    }

    public function getAedSold($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('currency_id', 4)
            ->where('trade_type_id', 2)
            ->sum('amount');
    }

    public function getNairaPurchaseValue($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('trade_type_id', 1)
            ->sum('value');
    }

    public function getNairaSoldValue($period)
    {
        return Transaction::where('created_at', 'like', $period.'%')
            ->where('trade_type_id', 2)
            ->sum('value');
    }
}