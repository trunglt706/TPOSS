<?php

namespace Modules\Stores\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminRole;

class SeedRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminPermission::ofExtension(['stores', 'permissions'])->each(function ($model) {
            $model->delete();
        });
        //======== stores
        $stores = AdminPermission::create([
            'name' => 'permission_stores',
            'extension' => 'stores',
            'icon' => '<i class="fa-solid fa-store"></i>'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $stores->id,
                'extension' => $role
            ]);
        }

        //======== permissions
        $permissions = AdminPermission::create([
            'name' => 'permission_permissions',
            'extension' => 'permissions',
            'icon' => '<i class="fa-solid fa-circle-check"></i>'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $permissions->id,
                'extension' => $role
            ]);
        }
    }
}
