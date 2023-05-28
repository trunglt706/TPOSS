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
        //
    }

    public function updating(AdminPermission $permission)
    {
    }

    public function updated(AdminPermission $permission)
    {
    }

    public function deleted(AdminPermission $permission)
    {
    }

    public function restored(AdminPermission $permission)
    {
        //
    }

    public function forceDeleted(AdminPermission $permission)
    {
        //
    }
}
