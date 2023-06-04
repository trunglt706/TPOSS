<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminEmails;

class AdminEmailObserver
{
    public function creating(AdminEmails $email)
    {
        $email->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
    }

    public function created(AdminEmails $email)
    {
        //
    }

    public function updating(AdminEmails $email)
    {
        $email->updated_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
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
