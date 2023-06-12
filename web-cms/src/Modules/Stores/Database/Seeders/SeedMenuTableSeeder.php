<?php

namespace Modules\Stores\Database\Seeders;

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
        AdminMenus::ofName('permission_stores')->each(function ($model) {
            $model->delete();
        });

        $customer = AdminMenus::ofName('permission_admin_customers')->first();
        if ($customer) {
            AdminMenus::create([
                'name' => 'permission_stores',
                'route' => route('admin.stores.index'),
                'parent_id' => $customer->id,
            ]);
        }
    }
}
