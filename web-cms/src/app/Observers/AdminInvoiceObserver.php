<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminInvoice;

class AdminInvoiceObserver
{
    public function creating(AdminInvoice $invoice)
    {
        $invoice->status = $invoice->status ?? AdminInvoice::STATUS_WAIT;
    }

    public function created(AdminInvoice $invoice)
    {
        //
    }

    public function updating(AdminInvoice $invoice)
    {
    }

    public function updated(AdminInvoice $invoice)
    {
    }

    public function deleted(AdminInvoice $invoice)
    {
    }

    public function restored(AdminInvoice $invoice)
    {
        //
    }

    public function forceDeleted(AdminInvoice $invoice)
    {
        //
    }
}
