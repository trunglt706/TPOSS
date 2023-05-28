<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminGroupRoleSample;
use Modules\Admins\Entities\AdminRoleDetail;
use Modules\Admins\Entities\Admins;

class AdminObserver
{
    public function creating(Admins $admin)
    {
        $admin->created_by = Auth::guard('admin')->user()->id;
    }

    public function created(Admins $admin)
    {
        // add to admin_role_details
        foreach (AdminGroupRoleSample::groupId($admin->group_id ?? null)->get() as $permission) {
            AdminRoleDetail::firstOrCreate([
                'permission_id' => $permission->permission_id,
                'admin_id' => $admin->id,
                'role_id' => $permission->role_id ?? null,
                'status' => AdminRoleDetail::STATUS_ACTIVE
            ]);
        }
    }

    public function updating(Admins $admin)
    {
    }

    public function updated(Admins $admin)
    {
    }

    public function deleted(Admins $admin)
    {
        $admin->status = Admins::STATUS_DELETED;
        $admin->deleted_by = Auth::guard('admin')->user()->id;

        // delete admin_role_details
        AdminRoleDetail::adminId($admin->id)->delete();
    }

    public function restored(Admins $admin)
    {
        $admin->status = Admins::STATUS_ACTIVE;

        // add to admin_role_details
        foreach (AdminGroupRoleSample::groupId($admin->group_id ?? null)->get() as $permission) {
            AdminRoleDetail::firstOrCreate([
                'permission_id' => $permission->permission_id,
                'admin_id' => $admin->id,
                'role_id' => $permission->role_id ?? null,
                'status' => AdminRoleDetail::STATUS_ACTIVE
            ]);
        }
    }

    public function forceDeleted(Admins $admin)
    {
        //
    }
}
