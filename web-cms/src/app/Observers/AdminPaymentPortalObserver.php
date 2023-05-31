<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminPaymentPortal;

class AdminPaymentPortalObserver
{
    public function creating(AdminPaymentPortal $portal)
    {
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
