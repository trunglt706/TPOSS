<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\BackupDB;

class AdminBackupDBObserver
{
    public function creating(BackupDB $backup)
    {
        $backup->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
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
        // remove in s3
        Storage::delete($backup->link);
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
