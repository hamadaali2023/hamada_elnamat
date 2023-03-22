<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    
    protected $commands = [
        // \App\Console\Commands\expiration::class,
        \App\Console\Commands\VideoViews::class,
    ];

    
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('user:expire')->everyMinute();

        $schedule->command('videoviews:expire')->everyMinute();
    }

    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
