<?php

namespace App\Observers;

use Modules\Admins\Entities\InvoicePortal;

class AdminInvoicePortalObserver
{
    public function creating(InvoicePortal $portal)
    {
        $portal->status = $portal->status ?? InvoicePortal::STATUS_ACTIVE;
    }

    public function created(InvoicePortal $portal)
    {
        //
    }

    public function updating(InvoicePortal $portal)
    {
    }

    public function updated(InvoicePortal $portal)
    {
    }

    public function deleted(InvoicePortal $portal)
    {
    }

    public function restored(InvoicePortal $portal)
    {
        //
    }

    public function forceDeleted(InvoicePortal $portal)
    {
        //
    }
}
