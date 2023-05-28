<?php

namespace App\Observers;

use Modules\Admins\Entities\Service;

class ServiceObserver
{

    public function creating(Service $service)
    {
    }

    public function created(Service $service)
    {
        //
    }

    public function updating(Service $service)
    {
    }

    public function updated(Service $service)
    {
    }

    public function deleted(Service $service)
    {
    }

    public function restored(Service $service)
    {
        //
    }

    public function forceDeleted(Service $service)
    {
        //
    }
}
