<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminSetting;
use Modules\Admins\Entities\Service;
use Modules\Stores\Entities\Stores;

class SeedSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminSetting::truncate();

        //=============== admin_customers
        $admin_customers = AdminPermission::extension('admin_customers')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'customer-assigned-default',
                'permission_id' => $admin_customers->id,
                'name' => 'Chỉ định khách hàng mặc định cho admin',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admins',
                'value' => ''
            ]);
            AdminSetting::create([
                'code' => 'currency-default',
                'permission_id' => $admin_customers->id,
                'name' => 'Đơn vị tiền tệ mặc định',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => json_encode(Stores::get_currency()),
                'value' => Stores::CURRENCY_VN,
            ]);
        }

        //=============== admin_leads
        $admin_leads = AdminPermission::extension('admin_leads')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'lead-assigned-default',
                'permission_id' => $admin_leads->id,
                'name' => 'Chỉ định khách hàng tiềm năng mặc định cho admin',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admins',
                'value' => ''
            ]);
        }

        //=============== services
        $services = AdminPermission::extension('services')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'support-device-default',
                'permission_id' => $services->id,
                'name' => 'Thiết bị được hỗ trợ mặc định',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => json_encode([Service::SUPPORT_WEB, Service::SUPPORT_WINDOW, Service::SUPPORT_MAC, Service::SUPPORT_ANDROID, Service::SUPPORT_IOS]),
                'value' => Service::SUPPORT_WEB,
            ]);
        }

        //=============== stores
        $stores = AdminPermission::extension('stores')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'admin-area-default',
                'permission_id' => $stores->id,
                'name' => 'Khu vực mặc định',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admin_areas',
                'value' => '',
                'description' => 'Nếu cửa hàng thuộc khách hàng, hệ thống sẽ lấy khu vực theo khách hàng'
            ]);
            AdminSetting::create([
                'code' => 'store-assigned-default',
                'permission_id' => $stores->id,
                'name' => 'Chỉ định cửa hàng mặc định cho admin',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admins',
                'value' => '',
                'description' => 'Nếu cửa hàng thuộc khách hàng, hệ thống sẽ lấy phân công theo khách hàng'
            ]);
        }

        //=============== admins
        $admins = AdminPermission::extension('admins')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'admin-url-firebase',
                'permission_id' => $admins->id,
                'name' => 'Đường dẫn firebase',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'https://fcm.googleapis.com/fcm/send',
            ]);
            AdminSetting::create([
                'code' => 'admin-key-firebase',
                'permission_id' => $admins->id,
                'name' => 'Firebase key',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'AAAAu3FpqXg:APA91bFPk9cAT0wVh-YEk5OUYwpi23zHEiJ85GDRdbVk20cxCcFrt2pb8ZUe1qU4EklBpltcwPTLPdtIC9n7LeGQucHSfP9tAe97-GSlgQws25vBCXMzS3KOntB9iTR8IrB11sU5TUYs',
            ]);
        }
    }
}
