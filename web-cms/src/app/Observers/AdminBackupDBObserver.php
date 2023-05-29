<?php

namespace App\Observers;

use Modules\Admins\Entities\BackupDB;

class AdminBackupDBObserver
{
    public function creating(BackupDB $backup)
    {
    }

    public function created(BackupDB $backup)
    {
        //
    }

    public function updating(BackupDB $backup)
    {
    }

    public function updated(BackupDB $backup)
    {
    }

    public function deleted(BackupDB $backup)
    {
    }

    public function restored(BackupDB $backup)
    {
        //
    }

    public function forceDeleted(BackupDB $backup)
    {
        //
    }
}
