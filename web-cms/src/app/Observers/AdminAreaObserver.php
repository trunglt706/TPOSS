<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\Area;

class AdminAreaObserver
{
    public function creating(Area $area)
    {
        $area->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 1;
    }

    public function created(Area $area)
    {
        //
    }

    public function updating(Area $area)
    {
    }

    public function updated(Area $area)
    {
    }

    public function deleted(Area $area)
    {
    }

    public function restored(Area $area)
    {
        //
    }

    public function forceDeleted(Area $area)
    {
        //
    }
}
