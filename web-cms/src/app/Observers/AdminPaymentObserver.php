<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminPayment;

class AdminPaymentObserver
{
    public function creating(AdminPayment $payment)
    {
        $payment->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $payment->type = $payment->type ?? AdminPayment::TYPE_THU;
        $payment->status = $payment->status ?? AdminPayment::STATUS_FAILED;
    }

    public function created(AdminPayment $payment)
    {
        //
    }

    public function updating(AdminPayment $payment)
    {
    }

    public function updated(AdminPayment $payment)
    {
    }

    public function deleted(AdminPayment $payment)
    {
        if ($payment->attachment) {
            Storage::delete($payment->attachment);
        }
    }

    public function restored(AdminPayment $payment)
    {
        //
    }

    public function forceDeleted(AdminPayment $payment)
    {
        //
    }
}
