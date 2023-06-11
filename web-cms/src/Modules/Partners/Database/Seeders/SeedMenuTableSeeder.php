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
        AdminMenus::ofName('permission_partner')->first()->delete();

        //===== setting
        $partner = AdminMenus::create([
            'name' => 'permission_partner',
            'icon' => '<i class="fa-solid fa-handshake"></i>'
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_licenses',
            'route' => route('admin.partner_licenses.index'),
            'parent_id' => $partner->id,
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_list',
            'route' => route('admin.partners.index'),
            'parent_id' => $partner->id,
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_domains',
            'route' => route('admin.partner_domains.index'),
            'parent_id' => $partner->id,
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_histories',
            'route' => route('admin.partner_histories.index'),
            'parent_id' => $partner->id,
        ]);
        AdminMenus::create([
            'name' => 'permission_partner_notifies',
            'route' => route('admin.partner_notifies.index'),
            'parent_id' => $partner->id,
        ]);
    }
}
