<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminContact;

class AdminContactObserver
{
    public function creating(AdminContact $contact)
    {
    }

    public function created(AdminContact $contact)
    {
        //
    }

    public function updating(AdminContact $contact)
    {
    }

    public function updated(AdminContact $contact)
    {
    }

    public function deleted(AdminContact $contact)
    {
    }

    public function restored(AdminContact $contact)
    {
        //
    }

    public function forceDeleted(AdminContact $contact)
    {
        //
    }
}
