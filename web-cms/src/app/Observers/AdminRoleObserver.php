<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminRole;

class AdminRoleObserver
{
    public function creating(AdminRole $role)
    {
    }

    public function created(AdminRole $role)
    {
        // add to group role sample
    }

    public function updating(AdminRole $role)
    {
    }

    public function updated(AdminRole $role)
    {
    }

    public function deleted(AdminRole $role)
    {
        // delete out group role sample
    }

    public function restored(AdminRole $role)
    {
        // add to group role sample
    }

    public function forceDeleted(AdminRole $role)
    {
        //
    }
}
