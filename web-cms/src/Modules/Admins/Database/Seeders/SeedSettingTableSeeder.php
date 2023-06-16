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
        //=============== admin_customers
        $admin_customers = AdminPermission::ofExtension('admin_customers')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'customer-assigned-default',
                'permission_id' => $admin_customers->id,
                'name' => 'Chỉ định khách hàng mặc định cho admin',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admins',
                'value' => '',
                'group' => 'admin_customers',
            ]);
            AdminSetting::create([
                'code' => 'currency-default',
                'permission_id' => $admin_customers->id,
                'name' => 'Đơn vị tiền tệ mặc định',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => json_encode(Stores::get_currency()),
                'value' => Stores::CURRENCY_VN,
                'group' => 'admin_customers',
            ]);
            AdminSetting::create([
                'code' => 'hide-phone-customer',
                'permission_id' => $admin_customers->id,
                'name' => 'Ẩn số điện thoại khách hàng',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'group' => 'admin_customers',
            ]);
            AdminSetting::create([
                'code' => 'time-force-delete-customers',
                'permission_id' => $admin_customers->id,
                'name' => 'Thời gian hệ thống bắt buộc xóa các khách hàng đã xóa tạm',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 6,
                'group' => 'admin_customers',
                'description' => 'Thời gian tính theo tháng'
            ]);
        }

        //=============== admin_leads
        $admin_leads = AdminPermission::ofExtension('admin_leads')->first();
        if ($admin_leads) {
            AdminSetting::create([
                'code' => 'lead-assigned-default',
                'permission_id' => $admin_leads->id,
                'name' => 'Chỉ định khách hàng tiềm năng mặc định cho admin',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => 'admins',
                'value' => '',
                'group' => 'admin_leads',
            ]);
            AdminSetting::create([
                'code' => 'hide-phone-lead',
                'permission_id' => $admin_leads->id,
                'name' => 'Ẩn số điện thoại khách hàng tiềm năng',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'group' => 'admin_leads',
            ]);
            AdminSetting::create([
                'code' => 'time-force-delete-leads',
                'permission_id' => $admin_leads->id,
                'name' => 'Thời gian hệ thống bắt buộc xóa các khách hàng tiềm năng đã xóa tạm',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 6,
                'group' => 'admin_leads',
                'description' => 'Thời gian tính theo tháng'
            ]);
        }

        //=============== services
        $services = AdminPermission::ofExtension('services')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'support-device-default',
                'permission_id' => $services->id,
                'name' => 'Thiết bị được hỗ trợ mặc định',
                'type' => AdminSetting::TYPE_SELECT,
                'data' => json_encode([Service::SUPPORT_WEB, Service::SUPPORT_WINDOW, Service::SUPPORT_MAC, Service::SUPPORT_ANDROID, Service::SUPPORT_IOS]),
                'value' => Service::SUPPORT_WEB,
                'group' => 'services',
            ]);
            AdminSetting::create([
                'code' => 'time-force-delete-services',
                'permission_id' => $services->id,
                'name' => 'Thời gian hệ thống bắt buộc xóa các dịch vụ đã xóa tạm',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 6,
                'group' => 'services',
                'description' => 'Thời gian tính theo tháng'
            ]);
        }

        //=============== admins
        $admins = AdminPermission::ofExtension('admins')->first();
        if ($admin_customers) {
            AdminSetting::create([
                'code' => 'admin-url-firebase',
                'permission_id' => $admins->id,
                'name' => 'Đường dẫn firebase',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'https://fcm.googleapis.com/fcm/send',
                'group' => 'firebase'
            ]);
            AdminSetting::create([
                'code' => 'admin-key-firebase',
                'permission_id' => $admins->id,
                'name' => 'Firebase key',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'AAAAu3FpqXg:APA91bFPk9cAT0wVh-YEk5OUYwpi23zHEiJ85GDRdbVk20cxCcFrt2pb8ZUe1qU4EklBpltcwPTLPdtIC9n7LeGQucHSfP9tAe97-GSlgQws25vBCXMzS3KOntB9iTR8IrB11sU5TUYs',
                'group' => 'firebase'
            ]);
            AdminSetting::create([
                'code' => 'hide-phone-admin',
                'permission_id' => $admins->id,
                'name' => 'Ẩn số điện thoại quản trị viên',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'group' => 'admin'
            ]);
            AdminSetting::create([
                'code' => 'time-force-delete-admin',
                'permission_id' => $admins->id,
                'name' => 'Thời gian hệ thống bắt buộc xóa các quản trị viên đã xóa tạm',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 6,
                'group' => 'admin',
                'description' => 'Thời gian tính theo tháng'
            ]);
            AdminSetting::create([
                'code' => 'time-two-factory-expire',
                'permission_id' => $admins->id,
                'name' => 'Thời gian tồn tại mã xác thực 2 lớp',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 3,
                'group' => 'login',
                'description' => 'Thời gian tính theo phút'
            ]);
        }

        //=============== admin_settings
        $admin_settings = AdminPermission::ofExtension('admin_settings')->first();
        if ($admin_settings) {
            AdminSetting::create([
                'code' => 'admin-seo-name',
                'permission_id' => $admin_settings->id,
                'name' => 'Tên hệ thống',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'Hệ thống quản lý đa dịch vụ',
                'group' => 'seo'
            ]);
            AdminSetting::create([
                'code' => 'admin-seo-favicon',
                'permission_id' => $admins->id,
                'name' => 'Favicon',
                'type' => AdminSetting::TYPE_FILE,
                'value' => 'favicon.ico',
                'group' => 'seo'
            ]);
            AdminSetting::create([
                'code' => 'admin-seo-logo',
                'permission_id' => $admins->id,
                'name' => 'Logo hệ thống',
                'type' => AdminSetting::TYPE_FILE,
                'value' => 'assets/images/logo.png',
                'group' => 'seo'
            ]);
            AdminSetting::create([
                'code' => 'admin-seo-copyright',
                'permission_id' => $admins->id,
                'name' => 'Bản quyền',
                'type' => AdminSetting::TYPE_FILE,
                'value' => 'TPOS',
                'group' => 'seo'
            ]);

            // ==== pusher
            AdminSetting::create([
                'code' => 'pusher-app-id',
                'permission_id' => $admins->id,
                'name' => 'App ID',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => '1',
                'group' => 'pusher'
            ]);
            AdminSetting::create([
                'code' => 'pusher-app-key',
                'permission_id' => $admins->id,
                'name' => 'App Key',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'chip_retail',
                'group' => 'pusher'
            ]);
            AdminSetting::create([
                'code' => 'pusher-app-secret',
                'permission_id' => $admins->id,
                'name' => 'App secret',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => '89kzjhf9129nakj',
                'group' => 'pusher'
            ]);
            AdminSetting::create([
                'code' => 'pusher-app-host',
                'permission_id' => $admins->id,
                'name' => 'App host',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'slanger.nxcloud.vn',
                'group' => 'pusher'
            ]);
            AdminSetting::create([
                'code' => 'pusher-app-port',
                'permission_id' => $admins->id,
                'name' => 'App port',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => '24589',
                'group' => 'pusher'
            ]);
            AdminSetting::create([
                'code' => 'pusher-app-scheme',
                'permission_id' => $admins->id,
                'name' => 'App scheme',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'https',
                'group' => 'pusher'
            ]);
            AdminSetting::create([
                'code' => 'pusher-app-cluster',
                'permission_id' => $admins->id,
                'name' => 'App cluster',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'mt1',
                'group' => 'pusher'
            ]);

            //==== nocaptcha
            AdminSetting::create([
                'code' => 'nocaptcha-secret',
                'permission_id' => $admins->id,
                'name' => 'Secret',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => '6LdcR2UUAAAAAEs7Lv1sXvYtENMMzKdqFYRPWGiN',
                'group' => 'nocaptcha'
            ]);
            AdminSetting::create([
                'code' => 'nocaptcha-sitekey',
                'permission_id' => $admins->id,
                'name' => 'Site key',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'NOCAPTCHA_SITEKEY',
                'group' => 'nocaptcha'
            ]);

            //==== slack webhook
            AdminSetting::create([
                'code' => 'slack-webhook-url',
                'permission_id' => $admins->id,
                'name' => 'Slack webhook url',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'https://hooks.slack.com/services/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',
                'group' => 'slack'
            ]);
        }

        //=============== register_usings
        $register_usings = AdminPermission::ofExtension('register_usings')->first();
        if ($register_usings) {
            AdminSetting::create([
                'code' => 'hide-phone-register',
                'permission_id' => $register_usings->id,
                'name' => 'Ẩn số điện thoại đăng ký',
                'type' => AdminSetting::TYPE_CHECKBOX,
                'value' => true,
                'group' => 'register_usings',
            ]);
        }

        //=============== admin_emails
        $admin_emails = AdminPermission::ofExtension('admin_emails')->first();
        if ($admin_emails) {
            AdminSetting::create([
                'code' => 'mail-driver',
                'permission_id' => $admin_emails->id,
                'name' => 'Mail driver',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'smtp',
                'group' => 'mail',
            ]);
            AdminSetting::create([
                'code' => 'mail-host',
                'permission_id' => $admin_emails->id,
                'name' => 'Mail host',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'email-smtp.ap-southeast-1.amazonaws.com',
                'group' => 'mail',
            ]);
            AdminSetting::create([
                'code' => 'mail-port',
                'permission_id' => $admin_emails->id,
                'name' => 'Male port',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => '587',
                'group' => 'mail',
            ]);
            AdminSetting::create([
                'code' => 'mail-username',
                'permission_id' => $admin_emails->id,
                'name' => 'Mail username',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'AKIA54P2XX6465D54QWJ',
                'group' => 'mail',
            ]);
            AdminSetting::create([
                'code' => 'mail-password',
                'permission_id' => $admin_emails->id,
                'name' => 'Mail password',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'BANZXv/qfPPtRxJu9FGrJnqccWDt9pIMB72mz9zNNpz1',
                'group' => 'mail',
            ]);
            AdminSetting::create([
                'code' => 'mail-encryption',
                'permission_id' => $admin_emails->id,
                'name' => 'Mail encryption',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'tls',
                'group' => 'mail',
            ]);
            AdminSetting::create([
                'code' => 'mail-from-name',
                'permission_id' => $admin_emails->id,
                'name' => 'Mail from name',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'TPOS',
                'group' => 'mail',
            ]);
            AdminSetting::create([
                'code' => 'mail-from-address',
                'permission_id' => $admin_emails->id,
                'name' => 'Mail from address',
                'type' => AdminSetting::TYPE_INPUT,
                'value' => 'noreply@nxcloud.vn',
                'group' => 'mail',
            ]);
        }
    }
}
