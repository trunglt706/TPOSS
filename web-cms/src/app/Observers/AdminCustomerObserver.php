<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminLead;

class AdminCustomerObserver
{
    public function creating(AdminCustomer $customer)
    {
        $customer->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $customer->code = $customer->code ?? AdminCustomer::get_code_default();
        $customer->gender = $customer->gender ?? AdminLead::GENDER_OTHER;
        $customer->status = $customer->status ?? AdminCustomer::STATUS_ACTIVE;
        $customer->type = $customer->type ?? AdminCustomer::TYPE_OLD;

        // check assigned from config
        $customer->assigned_id = get_option('customer-assigned-default');
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
        $customer->deleted_by = Auth::guard('admin')->user()->id;
        // check and delete avatar in s3
        if ($customer->avatar) {
            Storage::delete($customer->avatar);
        }
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
