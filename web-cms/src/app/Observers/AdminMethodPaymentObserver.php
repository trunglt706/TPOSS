<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminMethodPayment;

class AdminMethodPaymentObserver
{
    public function creating(AdminMethodPayment $method)
    {
    }

    public function created(AdminMethodPayment $method)
    {
        // check and delete image in s3
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
