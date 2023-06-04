<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminGroupRoleSample;
use Modules\Admins\Entities\AdminPermission;

class AdminPermissionObserver
{
    public function creating(AdminPermission $permission)
    {
        $permission->order = $permission->order ?? AdminPermission::get_order();
        $permission->status = $permission->status ?? AdminPermission::STATUS_SUSPEND;
    }

    public function created(AdminPermission $permission)
    {
        // add to group role sample
        AdminGroup::each(function ($group) use ($permission) {
            AdminGroupRoleSample::firstOrCreate([
                'permission_id' => $permission->id,
                'group_id' => $group->id,
                'status' => AdminGroupRoleSample::STATUS_SUSPEND
            ]);
        });
    }

    public function updating(AdminPermission $permission)
    {
    }

    public function updated(AdminPermission $permission)
    {
    }

    public function deleted(AdminPermission $permission)
    {
        // delete out group role sample
        AdminGroupRoleSample::permissionId($permission->id)->delete();
    }

    public function restored(AdminPermission $permission)
    {
        // add to group role sample
        AdminGroup::each(function ($group) use ($permission) {
            AdminGroupRoleSample::firstOrCreate([
                'permission_id' => $permission->id,
                'group_id' => $group->id,
                'status' => AdminGroupRoleSample::STATUS_SUSPEND
            ]);
        });
    }

    public function forceDeleted(AdminPermission $permission)
    {
        //
    }
}
