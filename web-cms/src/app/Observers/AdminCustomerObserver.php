<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminSetting;

class AdminCustomerObserver
{
    public function creating(AdminCustomer $customer)
    {
        $customer->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 1;
        $customer->code = $customer->code ?? AdminCustomer::get_code_default();
        $customer->gender = $customer->gender ?? AdminLead::GENDER_OTHER;
        $customer->status = $customer->status ?? AdminCustomer::STATUS_ACTIVE;
        $customer->type = $customer->type ?? AdminCustomer::TYPE_OLD;

        // check assigned from config
        $setting = AdminSetting::ofCode('customer-assigned-default')->first();
        if ($setting) {
            $customer->assigned_id = $setting->value ?? '';
        }
    }

    public function created(AdminCustomer $customer)
    {
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
