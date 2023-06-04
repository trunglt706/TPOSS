<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminMethodPayment;

class AdminMethodPaymentObserver
{
    public function creating(AdminMethodPayment $method)
    {
        $method->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $method->status = $method->status ?? AdminMethodPayment::STATUS_ACTIVE;
        $method->order = $method->order ?? AdminMethodPayment::get_order();
        $method->has_portal = $method->has_portal ?? false;
    }

    public function created(AdminMethodPayment $method)
    {
        // check and delete image in s3
        if ($method->image) {
            Storage::delete($method->image);
        }
    }

    public function updating(AdminMethodPayment $method)
    {
    }

    public function updated(AdminMethodPayment $method)
    {
    }

    public function deleted(AdminMethodPayment $method)
    {
    }

    public function restored(AdminMethodPayment $method)
    {
        //
    }

    public function forceDeleted(AdminMethodPayment $method)
    {
        //
    }
}
