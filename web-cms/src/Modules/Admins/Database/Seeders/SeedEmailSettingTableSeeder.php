<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminEmails;
use Modules\Admins\Entities\AdminPermission;

class SeedEmailSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminEmails::truncate();

        // admins
        $admin = AdminPermission::extension('admins')->first();
        if ($admin) {
            AdminEmails::create([
                'name' => 'Kích hoạt tài khoản quản trị',
                'code' => 'active-admin-account',
                'content' => '<div>Vui lòng truy cập vào đây để kích hoạt tài khoản</div>',
                'data' => json_encode(['email', 'name', 'link']),
                'permission_id' => $admin->id,
            ]);
            AdminEmails::create([
                'name' => 'Chào mừng',
                'code' => 'welcome-admin',
                'content' => '<div>Chào mừng bạn đến với hệ thống của chúng tôi</div>',
                'data' => json_encode(['email', 'name', 'link']),
                'permission_id' => $admin->id,
            ]);
            AdminEmails::create([
                'name' => 'Bài viết hướng dẫn mới',
                'code' => 'new-post',
                'content' => '<div>Bài hướng dẫn ABC vừa mới được phát hành</div>',
                'data' => json_encode(['email', 'name', 'link', 'post_name']),
                'permission_id' => $admin->id,
            ]);
        }

        // admin_customers
        $admin_customers = AdminPermission::extension('admin_customers')->first();
        if ($admin_customers) {
            AdminEmails::create([
                'name' => 'Chỉ định khách hàng',
                'code' => 'assigned-customer',
                'content' => '<div>Bạn vừa mới được chỉ định thành người quản lý của khách hàng ABC</div>',
                'data' => json_encode(['email', 'name', 'link', 'customer_name', 'customer_phone', 'customer_address']),
                'permission_id' => $admin_customers->id,
            ]);
            AdminEmails::create([
                'name' => 'Nhắc nợ khách hàng',
                'code' => 'debt-reminder-customer',
                'content' => '<div>Khách hàng ABC vẫn còn nợ 100000k</div>',
                'data' => json_encode(['email', 'name', 'link', 'total_owe', 'customer_name', 'customer_phone', 'customer_address']),
                'permission_id' => $admin_customers->id,
            ]);
            AdminEmails::create([
                'name' => 'Mừng sinh nhật khách hàng',
                'code' => 'happy-birthday-customer',
                'content' => '<div>Chúc mừng sinh nhật đến khách hàng ABC</div>',
                'data' => json_encode(['email', 'name', 'link', 'birthday', 'customer_name', 'customer_phone', 'customer_address']),
                'permission_id' => $admin_customers->id,
            ]);
            AdminEmails::create([
                'name' => 'Thông báo gia hạn dịch vụ của khách hàng',
                'code' => 'extension-service-customer',
                'content' => '<div>Gửi thông báo gia hạn dịch vụ đến khách hàng ABC</div>',
                'data' => json_encode(['email', 'name', 'link', 'expired_at', 'customer_name', 'customer_phone', 'customer_address']),
                'permission_id' => $admin_customers->id,
            ]);
        }

        // admin_leads
        $admin_customers = AdminPermission::extension('admin_leads')->first();
        if ($admin_customers) {
            AdminEmails::create([
                'name' => 'Chỉ định khách hàng tiềm nằng',
                'code' => 'assigned-lead',
                'content' => '<div>Bạn vừa mới được chỉ định thành người quản lý của khách hàng tiềm năng ABC</div>',
                'data' => json_encode(['email', 'name', 'link', 'lead_name', 'lead_phone', 'lead_address']),
                'permission_id' => $admin_customers->id,
            ]);
        }
    }
}
