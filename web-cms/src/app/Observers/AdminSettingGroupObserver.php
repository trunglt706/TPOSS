<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminSetting;
use Modules\Admins\Entities\AdminSettingGroup;

class AdminSettingGroupObserver
{
    public function creating(AdminSettingGroup $group)
    {
        $group->status = $group->status ?? AdminSettingGroup::STATUS_ACTIVE;
        $group->order = $group->order ?? AdminSettingGroup::get_order();
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
        // delete all setting of group
        if ($group->settings) {
            $group->settings->delete();
        }
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
