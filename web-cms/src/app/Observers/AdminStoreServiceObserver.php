<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminServiceUsing;
use Modules\Admins\Entities\Service;

class AdminServiceUsingObserver
{
    public function creating(AdminServiceUsing $service)
    {
        $support_device_default = json_encode([
            Service::SUPPORT_WEB
        ]);
        $setting = Service::find($service->service_id ?? 0);
        if ($setting && $setting->support_device) {
            $support_device_default = $setting->support_device;
        }
        $service->support_device = $service->support_device ?? $support_device_default;
        $service->status = $service->status ?? AdminServiceUsing::STATUS_ACTIVE;
    }

    public function created(AdminServiceUsing $service)
    {
        //
    }

    public function updating(AdminServiceUsing $service)
    {
    }

    public function updated(AdminServiceUsing $service)
    {
    }

    public function deleted(AdminServiceUsing $service)
    {
    }

    public function restored(AdminServiceUsing $service)
    {
        //
    }

    public function forceDeleted(AdminServiceUsing $service)
    {
        //
    }
}
