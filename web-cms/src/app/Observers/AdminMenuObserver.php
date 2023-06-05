<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminMenus;

class AdminMenuObserver
{
    /**
     * Handle the AdminMenus "created" event.
     */
    public function created(AdminMenus $adminMenus): void
    {
        $adminMenus->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $adminMenus->status = $adminMenus->status ?? AdminMenus::STATUS_ACTIVE;
        $adminMenus->type = $adminMenus->type ?? AdminMenus::TYPE_MAIN;
        $adminMenus->target = $adminMenus->target ?? AdminMenus::TARGET_SELF;
        $adminMenus->level = $adminMenus->level ?? 0;
        $adminMenus->order = $adminMenus->order ?? AdminMenus::get_order($adminMenus->parent_id);
    }

    /**
     * Handle the AdminMenus "updated" event.
     */
    public function updated(AdminMenus $adminMenus): void
    {
        //
    }

    /**
     * Handle the AdminMenus "deleted" event.
     */
    public function deleted(AdminMenus $adminMenus): void
    {
        //
    }

    /**
     * Handle the AdminMenus "restored" event.
     */
    public function restored(AdminMenus $adminMenus): void
    {
        //
    }

    /**
     * Handle the AdminMenus "force deleted" event.
     */
    public function forceDeleted(AdminMenus $adminMenus): void
    {
        //
    }
}
