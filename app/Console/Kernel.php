<?php
namespace App\Console;

use App\Console\Commands\ProcessExpiredPlans;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Register your custom commands here
        ProcessExpiredPlans::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule the expired plans command to run daily
        $schedule->command('plans:process-expired')->daily();
         $schedule->call(function () {
        app(\App\Http\Controllers\User\PlanController::class)->handleExpiredPlans();
    })->daily(); // Runs daily at midnight
    }
    
    

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
    
  
}
