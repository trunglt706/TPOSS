<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Nwidart\Modules\Facades\Module;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        if (Module::has('Admins')) {
            $schedule->command('delete-reset-password-expired')->everyMinute();
            $schedule->command('register_usings:check_and_delete')->everyMinute();
            $schedule->command('admin:check_and_update_expired')->daily();
            $schedule->command('order:check-and-update-expire')->daily();
            $schedule->command('check_update:auto_backup_db')->weekly();
        }
        $schedule->command('telescope:prune')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
