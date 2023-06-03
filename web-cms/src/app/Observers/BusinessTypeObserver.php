<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\BusinessType;

class BusinessTypeObserver
{

    public function creating(BusinessType $type)
    {
        $type->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 1;
        $type->status = $type->status ?? BusinessType::STATUS_ACTIVE;
    }

    public function created(BusinessType $type)
    {
        //
    }

    public function updating(BusinessType $type)
    {
    }

    public function updated(BusinessType $type)
    {
    }

    public function deleted(BusinessType $type)
    {
        // delete table admin_store_BusinessType
    }

    public function restored(BusinessType $type)
    {
        //
    }

    public function forceDeleted(BusinessType $type)
    {
        //
    }
}
