<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\BlockVendor;

class AdminBlockVendorObserver
{
    public function creating(BlockVendor $vendor)
    {
        $vendor->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
    }

    public function created(BlockVendor $vendor)
    {
        //
    }

    public function updating(BlockVendor $vendor)
    {
    }

    public function updated(BlockVendor $vendor)
    {
    }

    public function deleted(BlockVendor $vendor)
    {
    }

    public function restored(BlockVendor $vendor)
    {
        //
    }

    public function forceDeleted(BlockVendor $vendor)
    {
        //
    }
}
