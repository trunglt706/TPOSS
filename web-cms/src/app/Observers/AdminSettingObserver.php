<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminSetting;

class AdminSettingObserver
{
    public function creating(AdminSetting $setting)
    {
    }

    public function created(AdminSetting $setting)
    {
        //
    }

    public function updating(AdminSetting $setting)
    {
    }

    public function updated(AdminSetting $setting)
    {
    }

    public function deleted(AdminSetting $setting)
    {
    }

    public function restored(AdminSetting $setting)
    {
        //
    }

    public function forceDeleted(AdminSetting $setting)
    {
        //
    }
}
