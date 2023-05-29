<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminCustomer;

class AdminCustomerObserver
{
    public function creating(AdminCustomer $customer)
    {
    }

    public function created(AdminCustomer $customer)
    {
        //
    }

    public function updating(AdminCustomer $customer)
    {
    }

    public function updated(AdminCustomer $customer)
    {
    }

    public function deleted(AdminCustomer $customer)
    {
    }

    public function restored(AdminCustomer $customer)
    {
        //
    }

    public function forceDeleted(AdminCustomer $customer)
    {
        //
    }
}
