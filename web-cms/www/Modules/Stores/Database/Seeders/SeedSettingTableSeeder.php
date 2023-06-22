<?php

namespace Modules\Stores\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminSetting;

class SeedSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //=============== stores
        $stores = AdminPermission::ofExtension('stores')->first();
        if ($stores) {
            AdminSetting::create([
                'code' => 'admin-area-default',
                'permission_id' => $stores->id,
                'name' => 'Khu vực mặc định',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admin_areas',
                'value' => '',
                'description' => 'Hệ thống sẽ lấy khu vực theo khách hàng',
                'group' => 'stores',
            ]);
            AdminSetting::create([
                'code' => 'store-assigned-default',
                'permission_id' => $stores->id,
                'name' => 'Chỉ định cửa hàng mặc định cho quản trị viên',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admins',
                'value' => '',
                'description' => 'Hệ thống sẽ phân công quản trị viên theo khách hàng',
                'group' => 'stores',
            ]);
            AdminSetting::create([
                'code' => 'time-force-delete-stores',
                'permission_id' => $stores->id,
                'name' => 'Thời gian hệ thống bắt buộc xóa các cửa hàng đã xóa tạm',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 6,
                'group' => 'stores',
                'description' => 'Thời gian tính theo tháng'
            ]);
        }
    }
}
