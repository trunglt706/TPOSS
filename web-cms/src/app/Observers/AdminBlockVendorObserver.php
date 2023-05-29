<?php

namespace App\Observers;

use Modules\Admins\Entities\BlockVendor;

class AdminBlockVendorObserver
{
    public function creating(BlockVendor $vendor)
    {
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
