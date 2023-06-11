<?php

namespace Modules\Partners\Database\Seeders;

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
        AdminSetting::has('permission', function ($query) {
            $query->ofExtension([
                'partners'
            ]);
        })->delete();

        //=============== admin_customers
        $partners = AdminPermission::ofExtension('partners')->first();
        if ($partners) {
            AdminSetting::create([
                'code' => 'auto-sync-history-partner',
                'permission_id' => $partners->id,
                'name' => 'Tự động đồng bộ lịch sử hoạt động của đối tác',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
            ]);
            AdminSetting::create([
                'code' => 'auto-send-notify-extend-license',
                'permission_id' => $partners->id,
                'name' => 'Tự động gửi thông báo gia hạn bản quyền',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true
            ]);
            AdminSetting::create([
                'code' => 'auto-suspend-license-if-validate',
                'permission_id' => $partners->id,
                'name' => 'Tự động khóa bản quyền nếu vượt quá số lần vi phạm',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'description' => 'Số lần vi phạm không vượt quá 3 lần mất tín hiệu gửi đến máy chủ trung tâm. Mỗi lần gửi cách nhau 10 phút.'
            ]);
        }
    }
}
