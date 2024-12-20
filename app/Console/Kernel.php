<?php

namespace App\Console;

use App\Console\Commands\MakeAvailableBed;
use App\Console\Commands\MakeAvailableRoom;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * 
     */
    protected $commands = [
        MakeAvailableBed::class,
        MakeAvailableRoom::class
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:check-hostel-package')->daily();
        $schedule->command('app:make-available-bed')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
