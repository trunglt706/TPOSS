<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Emails\EmailAdminActive;
use Modules\Admins\Emails\EmailAdminInfo;
use Modules\Admins\Emails\EmailAdminSuspended;
use Modules\Admins\Entities\AdminGroupRoleSample;
use Modules\Admins\Entities\AdminRoleDetail;
use Modules\Admins\Entities\Admins;

class AdminObserver
{
    public function creating(Admins $admin)
    {
        $admin->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
        $admin->password = $admin->password ?? Admins::get_password_default();
        $admin->gender = $admin->gender ?? Admins::GENDER_OTHER;
        $admin->status = $admin->status ?? Admins::STATUS_UN_ACTIVE;
        $admin->root = $admin->root ?? Admins::NOT_ROOT;
        $admin->supper = $admin->supper ?? Admins::NOT_SUPPER;
        $admin->code = $admin->code ?? Admins::get_code_default();
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
        // check and send email
        if ($admin->status == Admins::STATUS_UN_ACTIVE) {
            try {
                Mail::to($admin->email)->send(new EmailAdminActive($admin));
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else if ($admin->status == Admins::STATUS_ACTIVE) {
            try {
                Mail::to($admin->email)->send(new EmailAdminInfo($admin));
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    public function updating(Admins $admin)
    {
    }

    public function updated(Admins $admin)
    {
        if ($admin->status == Admins::STATUS_SUSPEND) {
            try {
                Mail::to($admin->email)->send(new EmailAdminSuspended($admin));
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    public function deleted(Admins $admin)
    {
        $admin->status = Admins::STATUS_DELETED;
        $admin->deleted_by = Auth::guard('admin')->user()->id;

        // delete admin_role_details
        AdminRoleDetail::adminId($admin->id)->delete();

        // check and delete avatar in s3
        if ($admin->avatar) {
            Storage::delete($admin->avatar);
        }
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
                'status' => $permission->status
            ]);
        }
    }

    public function forceDeleted(Admins $admin)
    {
        //
    }
}
