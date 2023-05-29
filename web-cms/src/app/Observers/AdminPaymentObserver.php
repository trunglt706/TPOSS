<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminPayment;

class AdminPaymentObserver
{
    public function creating(AdminPayment $payment)
    {
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
