<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminStoreService;

class AdminStoreServiceObserver
{
    public function creating(AdminStoreService $service)
    {
    }

    public function created(AdminStoreService $service)
    {
        //
    }

    public function updating(AdminStoreService $service)
    {
    }

    public function updated(AdminStoreService $service)
    {
    }

    public function deleted(AdminStoreService $service)
    {
    }

    public function restored(AdminStoreService $service)
    {
        //
    }

    public function forceDeleted(AdminStoreService $service)
    {
        //
    }
}
