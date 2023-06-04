<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminGroupRoleSample;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminRole;

class AdminGroupObserver
{
    public function creating(AdminGroup $group)
    {
        $group->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $group->order = $group->order ?? AdminGroup::get_order();
    }

    public function created(AdminGroup $group)
    {
        // add to table admin_group_role_samples
        foreach (AdminPermission::all() as $permission) {
            AdminGroupRoleSample::firstOrCreate([
                'permission_id' => $permission->id,
                'group_id' => $group->id,
                'status' => $group->id == 1 ? AdminGroupRoleSample::STATUS_ACTIVE : AdminGroupRoleSample::STATUS_SUSPEND
            ]);
            foreach (AdminRole::permissionId($permission->id)->get() as $role) {
                AdminGroupRoleSample::firstOrCreate([
                    'permission_id' => $permission->id,
                    'group_id' => $group->id,
                    'role_id' => $role->id,
                    'status' => $group->id == 1 ? AdminGroupRoleSample::STATUS_ACTIVE : AdminGroupRoleSample::STATUS_SUSPEND
                ]);
            }
        }
    }

    public function updating(AdminGroup $group)
    {
    }

    public function updated(AdminGroup $group)
    {
    }

    public function deleted(AdminGroup $group)
    {
        // delete table admin_group_role_samples
        AdminGroupRoleSample::groupId($group->id)->delete();
    }

    public function restored(AdminGroup $group)
    {
        //
    }

    public function forceDeleted(AdminGroup $group)
    {
        //
    }
}
