<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminPaymentPortal;

class AdminPaymentPortalObserver
{
    public function creating(AdminPaymentPortal $portal)
    {
        $portal->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $portal->order = $portal->order ?? AdminPaymentPortal::get_order();
        $portal->status = $portal->status ?? AdminPaymentPortal::STATUS_SUSPEND;
    }

    public function created(AdminPaymentPortal $portal)
    {
        //
    }

    public function updating(AdminPaymentPortal $portal)
    {
    }

    public function updated(AdminPaymentPortal $portal)
    {
    }

    public function deleted(AdminPaymentPortal $portal)
    {
        // check and delete image in s3
        if ($portal->image) {
            Storage::delete($portal->image);
        }
    }

    public function restored(AdminPaymentPortal $portal)
    {
        //
    }

    public function forceDeleted(AdminPaymentPortal $portal)
    {
        //
    }
}
