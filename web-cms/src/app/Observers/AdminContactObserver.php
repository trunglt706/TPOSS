<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminContact;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminLead;

class AdminContactObserver
{
    public function creating(AdminContact $contact)
    {
        $contact->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $contact->code = $contact->code ?? AdminContact::get_code_default();
        $contact->gender = $contact->gender ?? AdminLead::GENDER_OTHER;
        $contact->status = $contact->status ?? AdminContact::STATUS_ACTIVE;
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
        if ($contact->avatar) {
            Storage::delete($contact->avatar);
        }
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
