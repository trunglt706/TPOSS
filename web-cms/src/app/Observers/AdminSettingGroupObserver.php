<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminSettingGroup;

class AdminSettingGroupObserver
{
    public function creating(AdminSettingGroup $group)
    {
    }

    public function created(AdminSettingGroup $group)
    {
        //
    }

    public function updating(AdminSettingGroup $group)
    {
    }

    public function updated(AdminSettingGroup $group)
    {
    }

    public function deleted(AdminSettingGroup $group)
    {
    }

    public function restored(AdminSettingGroup $group)
    {
        //
    }

    public function forceDeleted(AdminSettingGroup $group)
    {
        //
    }
}
