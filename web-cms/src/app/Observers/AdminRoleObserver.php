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
        //
    }

    public function updating(AdminRole $role)
    {
    }

    public function updated(AdminRole $role)
    {
    }

    public function deleted(AdminRole $role)
    {
    }

    public function restored(AdminRole $role)
    {
        //
    }

    public function forceDeleted(AdminRole $role)
    {
        //
    }
}
