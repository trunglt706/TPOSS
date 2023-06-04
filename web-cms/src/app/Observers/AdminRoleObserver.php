<?php

namespace App\Observers;

use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminGroupRoleSample;
use Modules\Admins\Entities\AdminRole;

class AdminRoleObserver
{
    public function creating(AdminRole $role)
    {
        $role->status = $role->status ?? AdminRole::STATUS_ACTIVE;
        $role->order = $role->order ?? AdminRole::get_order($role->group_id ?? 0);
    }

    public function created(AdminRole $role)
    {
        // add to group role sample
        AdminGroup::each(function ($group) use ($role) {
            AdminGroupRoleSample::firstOrCreate([
                'group_id' => $group->id,
                'role_id' => $role->id,
                'permission_id' => $role->permission_id
            ]);
        });
    }

    public function updating(AdminRole $role)
    {
    }

    public function updated(AdminRole $role)
    {
    }

    public function deleted(AdminRole $role)
    {
        // delete out group role sample
        AdminGroupRoleSample::roleId($role->id)->delete();
    }

    public function restored(AdminRole $role)
    {
        // add to group role sample
        AdminGroup::each(function ($group) use ($role) {
            AdminGroupRoleSample::firstOrCreate([
                'group_id' => $group->id,
                'role_id' => $role->id,
                'permission_id' => $role->permission_id
            ]);
        });
    }

    public function forceDeleted(AdminRole $role)
    {
        //
    }
}
