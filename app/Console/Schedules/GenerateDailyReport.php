<?php

namespace App\Console\Schedules;

use App\Models\DailyReport;
use Carbon\Carbon;

class GenerateDailyReport
{
    public function __invoke()
    {
        $today = Carbon::now()->format('d/m/Y');

        DailyReport::create([
            'date' => $today
        ]);
    }
}