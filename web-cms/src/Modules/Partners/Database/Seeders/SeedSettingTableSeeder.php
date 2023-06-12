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
        //=============== partners
        $partners = AdminPermission::ofExtension('partners')->first();
        if ($partners) {
            AdminSetting::create([
                'code' => 'auto-sync-history-partners',
                'permission_id' => $partners->id,
                'name' => 'Tự động đồng bộ lịch sử hoạt động của đối tác',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'group' => 'partners',
            ]);
            AdminSetting::create([
                'code' => 'auto-send-notify-extend-license-partners',
                'permission_id' => $partners->id,
                'name' => 'Tự động gửi thông báo gia hạn bản quyền',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'group' => 'partners',
            ]);
            AdminSetting::create([
                'code' => 'auto-suspend-license-partners-if-validate',
                'permission_id' => $partners->id,
                'name' => 'Tự động khóa bản quyền nếu vượt quá số lần vi phạm',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'description' => 'Số lần vi phạm không vượt quá 3 lần mất tín hiệu gửi đến máy chủ trung tâm. Mỗi lần gửi cách nhau 10 phút.',
                'group' => 'partners',
            ]);
            AdminSetting::create([
                'code' => 'hide-phone-partners',
                'permission_id' => $partners->id,
                'name' => 'Ẩn số điện thoại đối tác',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'group' => 'partners',
            ]);
            AdminSetting::create([
                'code' => 'time-force-delete-partners',
                'permission_id' => $partners->id,
                'name' => 'Thời gian hệ thống bắt buộc xóa các đối tác đã xóa tạm',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 6,
                'group' => 'partners',
                'description' => 'Thời gian tính theo tháng'
            ]);
        }
    }
}
