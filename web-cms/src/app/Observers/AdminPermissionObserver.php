<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminPermission;

class AdminPermissionObserver
{
    public function creating(AdminPermission $permission)
    {
    }

    public function created(AdminPermission $permission)
    {
        // add to group role sample
    }

    public function updating(AdminPermission $permission)
    {
    }

    public function updated(AdminPermission $permission)
    {
    }

    public function deleted(AdminPermission $permission)
    {
        // delete out group role sample
    }

    public function restored(AdminPermission $permission)
    {
        // add to group role sample
    }

    public function forceDeleted(AdminPermission $permission)
    {
        //
    }
}
