<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Admins\Console\CheckAndAutoBackupDB;
use Modules\Admins\Console\CheckAndDeleteRegister;
use Modules\Admins\Console\CheckAndDeleteTwoFactoryExpired;
use Modules\Admins\Console\CheckAndUpdateAdminExpired;
use Modules\Admins\Console\CheckAndUpdateOrderExpired;
use Modules\Admins\Console\DeleteResetPasswordExpire;
use Modules\Stores\Console\CheckAndUpdateKeyStoreExpired;
use Modules\Stores\Console\CheckAndUpdateUserExpired;
use Nwidart\Modules\Facades\Module;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        if (Module::has('Admins')) {
            $schedule->command('check-and-delete-two-factory-expired')->everyMinute();
            $schedule->command('delete-reset-password-expired')->everyMinute();
            $schedule->command('register_usings:check_and_delete')->everyMinute();
            $schedule->command('admin:check_and_update_expired')->daily();
            $schedule->command('order:check-and-update-expire')->daily();
            $schedule->command('check_update:auto_backup_db')->weekly();
        }

        if (Module::has('Stores')) {
            $schedule->command('check_and_update_key_store_expired')->daily();
            $schedule->command('check_and_update_user_expired')->daily();
        }

        if (Module::has('Partners')) {
        }

        $schedule->command('telescope:prune')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        if (Module::has('Admins')) {
            $this->commands([
                CheckAndAutoBackupDB::class,
                CheckAndDeleteRegister::class,
                CheckAndDeleteTwoFactoryExpired::class,
                CheckAndUpdateAdminExpired::class,
                CheckAndUpdateOrderExpired::class,
                DeleteResetPasswordExpire::class
            ]);
        }

        if (Module::has('Stores')) {
            $this->commands([
                CheckAndUpdateKeyStoreExpired::class,
                CheckAndUpdateUserExpired::class,
            ]);
        }

        if (Module::has('Partners')) {
            $this->commands([]);
        }

        require base_path('routes/console.php');
    }
}
