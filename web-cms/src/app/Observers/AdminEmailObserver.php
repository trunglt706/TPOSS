<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminEmails;

class AdminEmailObserver
{
    public function creating(AdminEmails $email)
    {
    }

    public function created(AdminEmails $email)
    {
        //
    }

    public function updating(AdminEmails $email)
    {
    }

    public function updated(AdminEmails $email)
    {
    }

    public function deleted(AdminEmails $email)
    {
    }

    public function restored(AdminEmails $email)
    {
        //
    }

    public function forceDeleted(AdminEmails $email)
    {
        //
    }
}
