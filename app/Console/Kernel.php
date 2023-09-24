<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendEmails::class,
        Commands\GroupOperations::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('email:send inActive')->daily();
        $schedule->command('queue:work')->daily()->withoutOverlapping();
        $schedule->command('email:send cardExpiry')->everyTenMinutes();
        $schedule->command('group:operation update')->daily();
        $schedule->command('group:operation updateCard')->everyFiveMinutes();
        $schedule->command('group:operation updateCardStatus')->everyFiveMinutes();
        // $schedule->command('email:send testMail')->everyMinute()->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
