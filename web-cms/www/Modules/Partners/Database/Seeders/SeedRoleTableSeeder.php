<?php

namespace Modules\Partners\Database\Seeders;

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
        AdminPermission::ofGroup('partners')->each(function ($model) {
            $model->delete();
        });

        //======== partners
        $partners = AdminPermission::create([
            'name' => 'permission_partner',
            'extension' => 'partners',
            'icon' => '<i class="fa-solid fa-handshake"></i>',
            'group' => 'partners'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $partners->id,
                'extension' => $role
            ]);
        }

        //======== partner_domains
        $partner_domains = AdminPermission::create([
            'name' => 'permission_partner_domains',
            'extension' => 'partner_domains',
            'icon' => '<i class="fa-solid fa-globe"></i>',
            'group' => 'partners'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $partner_domains->id,
                'extension' => $role
            ]);
        }

        //======== partner_histories
        $partner_histories = AdminPermission::create([
            'name' => 'permission_partner_histories',
            'extension' => 'partner_histories',
            'icon' => '<i class="fa-solid fa-clock-rotate-left"></i>',
            'group' => 'partners'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $partner_histories->id,
                'extension' => $role
            ]);
        }

        //======== partner_notifies
        $partner_notifies = AdminPermission::create([
            'name' => 'permission_partner_notifies',
            'extension' => 'partner_notifies',
            'icon' => '<i class="fa-solid fa-bell"></i>',
            'group' => 'partners'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $partner_notifies->id,
                'extension' => $role
            ]);
        }

        //======== partner_licenses
        $partner_licenses = AdminPermission::create([
            'name' => 'permission_partner_licenses',
            'extension' => 'partner_licenses',
            'icon' => '<i class="fa-solid fa-key"></i>',
            'group' => 'partners'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $partner_licenses->id,
                'extension' => $role
            ]);
        }
    }
}
