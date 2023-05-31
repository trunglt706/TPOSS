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
        // send notify to admin assigned and admin have permission
        // send to email

        // send to slack

        // send to pusher

        // send to firebase
    }

    public function updating(AdminCustomer $customer)
    {
    }

    public function updated(AdminCustomer $customer)
    {
    }

    public function deleted(AdminCustomer $customer)
    {
        // check and delete avatar in s3
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
