<?php

namespace App\Console;

use App\Console\Schedules\CloseBalance;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Schedules\GenerateDailyReport;
use App\Console\Schedules\GenerateMonthlyReportSummary;
use App\Console\Schedules\RolloverBalance;
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
        $schedule->command('queue:work --daemon')
            ->everyFiveMinutes()->withoutOverlapping();

        // trade balance rollover
        $schedule->call(new RolloverBalance)
            ->days(range(1, 6))
            ->at('07:00');

        // generate daily trade report
//        $schedule->call(new GenerateDailyReport)
//            ->days(range(1, 6))
//            ->at('07:30');

        // close trading balance
//        $schedule->call(new CloseBalance)
//            ->days(range(1, 6))
//            ->at('20:00');

        // generate monthly trade summary report
        $schedule->call(new GenerateMonthlyReportSummary)
            ->lastDayOfMonth()
            ->at('21:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
