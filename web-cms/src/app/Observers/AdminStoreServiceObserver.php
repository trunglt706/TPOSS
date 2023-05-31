<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminServiceUsing;

class AdminServiceUsingObserver
{
    public function creating(AdminServiceUsing $service)
    {
    }

    public function created(AdminServiceUsing $service)
    {
        //
    }

    public function updating(AdminServiceUsing $service)
    {
    }

    public function updated(AdminServiceUsing $service)
    {
    }

    public function deleted(AdminServiceUsing $service)
    {
    }

    public function restored(AdminServiceUsing $service)
    {
        //
    }

    public function forceDeleted(AdminServiceUsing $service)
    {
        //
    }
}
