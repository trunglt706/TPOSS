<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminRole;
use Modules\Admins\Entities\AdminRoleDetail;
use Modules\Admins\Entities\Admins;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // gate for admin
        Gate::define('isAdmin', function (Admins $admin) {
            return $admin->supper == Admins::IS_SUPPER && $admin->status == Admins::STATUS_ACTIVE;
        });

        foreach (AdminPermission::all() as $permission) {
            Gate::define($permission->extension, function (Admins $admin) use ($permission) {
                return AdminRoleDetail::permissionId($permission->id)->adminId($admin->id)->whereNull('role_id')->active()->first();
            });
            foreach (AdminRole::permissionId($permission->id)->get() as $role) {
                Gate::define($permission->extension . '|' . $role->extension, function (Admins $admin) use ($permission, $role) {
                    return AdminRoleDetail::permissionId($permission->id)->adminId($admin->id)->roleId($role->id)->active()->first();
                });
            }
        }
    }
}
