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
        $group->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 1;
    }

    public function created(AdminGroup $group)
    {
        // add to table admin_group_role_samples
        foreach (AdminPermission::all() as $permission) {
            AdminGroupRoleSample::firstOrCreate([
                'permission_id' => $permission->id,
                'group_id' => $group->id,
            ]);
            foreach (AdminRole::permissionId($permission->id)->get() as $role) {
                AdminGroupRoleSample::firstOrCreate([
                    'permission_id' => $permission->id,
                    'group_id' => $group->id,
                    'role_id' => $role->id
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
