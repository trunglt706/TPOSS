<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminSetting;
use Modules\Admins\Entities\Service;

class AdminServiceObserver
{
    public function creating(Service $service)
    {
        $service->status = $service->status ?? Service::STATUS_ACTIVE;
        $service->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;

        $support_device_default = json_encode([
            Service::SUPPORT_WEB
        ]);
        $setting = AdminSetting::ofCode('support-device-default')->first();
        if ($setting && $setting->value) {
            $support_device_default = $setting->value;
        }
        $service->support_device = $service->support_device ?? $support_device_default;
    }

    public function created(Service $service)
    {
        //
    }

    public function updating(Service $service)
    {
    }

    public function updated(Service $service)
    {
    }

    public function deleted(Service $service)
    {
        // check and delete image in s3
        if ($service->image) {
            Storage::delete($service->image);
        }
    }

    public function restored(Service $service)
    {
        //
    }

    public function forceDeleted(Service $service)
    {
        //
    }
}
