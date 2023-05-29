<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminTokenDevice;

class AdminTokenDeviceObserver
{
    public function creating(AdminTokenDevice $token)
    {
    }

    public function created(AdminTokenDevice $token)
    {
        //
    }

    public function updating(AdminTokenDevice $token)
    {
    }

    public function updated(AdminTokenDevice $token)
    {
    }

    public function deleted(AdminTokenDevice $token)
    {
    }

    public function restored(AdminTokenDevice $token)
    {
        //
    }

    public function forceDeleted(AdminTokenDevice $token)
    {
        //
    }
}
