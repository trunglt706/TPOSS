<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\Admins;

class SeedAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminGroup::truncate();
        Admins::truncate();

        $group = AdminGroup::create([
            'name' => 'Quản trị viên',
            'description' => 'Có toàn quyền',
            'status' => AdminGroup::STATUS_ACTIVE,
            'order' => 0,
            'created_by' => 1
        ]);

        Admins::create([
            'name' => 'Super admin',
            'email' => 'tpos_admin@gmail.com',
            'phone' => '0909000999',
            'group_id' => $group->id,
            'status' => Admins::STATUS_ACTIVE,
            'root' => Admins::IS_ROOT,
            'supper' => Admins::IS_SUPPER,
        ]);
    }
}
