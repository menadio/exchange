<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Schedules\GenerateDailyReport;
use App\Console\Schedules\GenerateMonthlyReportSummary;
use App\Services\ReportService;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // generate daily trade report
        $schedule->call(new GenerateDailyReport)
            ->days(range(1,6))
            ->at('16:17');

        // generate monthly trade summary report
        $schedule->call(new GenerateMonthlyReportSummary)
            ->lastDayOfMonth()
            ->at('19:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
