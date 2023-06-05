<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminSetting;

class AdminLeadObserver
{
    public function creating(AdminLead $lead)
    {
        $lead->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $lead->code = $lead->code ?? AdminLead::get_code_default();
        $lead->gender = $lead->gender ?? AdminLead::GENDER_OTHER;
        $lead->status = $lead->status ?? AdminLead::STATUS_ACTIVE;

        // check assigned from config
        $setting = AdminSetting::ofCode('lead-assigned-default')->first();
        if ($setting) {
            $lead->assigned_id = $setting->value ?? '';
        }
    }

    public function created(AdminLead $lead)
    {
        //
    }

    public function updating(AdminLead $lead)
    {
    }

    public function updated(AdminLead $lead)
    {
    }

    public function deleted(AdminLead $lead)
    {
        $lead->deleted_by = Auth::guard('admin')->user()->id;
        // check and delete avatar in s3
        if ($lead->avatar) {
            Storage::delete($lead->avatar);
        }
    }

    public function restored(AdminLead $lead)
    {
        //
    }

    public function forceDeleted(AdminLead $lead)
    {
        //
    }
}
