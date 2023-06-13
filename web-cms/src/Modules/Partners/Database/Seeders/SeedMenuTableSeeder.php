<?php

namespace Modules\Partners\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminMenus;

class SeedMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminMenus::ofName('permission_partner')->each(function ($model) {
            $model->delete();
        });

        //===== setting
        $partner = AdminMenus::create([
            'name' => 'permission_partner',
            'icon' => '<i class="fa-solid fa-handshake"></i>'
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_list',
            'route' => admin_get_full_link_host('admin.partners.index'),
            'parent_id' => $partner->id,
            'extension' => 'partners',
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_licenses',
            'route' => admin_get_full_link_host('admin.partner_licenses.index'),
            'parent_id' => $partner->id,
            'extension' => 'partner_licenses',
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_notifies',
            'route' => admin_get_full_link_host('admin.partner_notifies.index'),
            'parent_id' => $partner->id,
            'extension' => 'partner_notifies',
        ]);
    }
}
