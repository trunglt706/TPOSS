<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminSetting;

class AdminSettingObserver
{
    public function creating(AdminSetting $setting)
    {
        $setting->order = $setting->order ?? AdminSetting::get_order($setting->permission_id ?? 0);
        $setting->type = $setting->type ?? AdminSetting::TYPE_INPUT;
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
        if ($setting->type == AdminSetting::TYPE_FILE && $setting->value) {
            Storage::delete($setting->value);
        }
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
