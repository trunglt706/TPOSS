<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminMenus;

class AdminMenuObserver
{
    /**
     * Handle the AdminMenus "created" event.
     */
    public function created(AdminMenus $adminMenus): void
    {
        //
    }

    /**
     * Handle the AdminMenus "updated" event.
     */
    public function updated(AdminMenus $adminMenus): void
    {
        //
    }

    /**
     * Handle the AdminMenus "deleted" event.
     */
    public function deleted(AdminMenus $adminMenus): void
    {
        //
    }

    /**
     * Handle the AdminMenus "restored" event.
     */
    public function restored(AdminMenus $adminMenus): void
    {
        //
    }

    /**
     * Handle the AdminMenus "force deleted" event.
     */
    public function forceDeleted(AdminMenus $adminMenus): void
    {
        //
    }
}
