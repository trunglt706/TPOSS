<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminMenus;

class SeedAdminMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminMenus::ofName([
            'permission_dashboard', 'permission_main', 'permission_manager_admin',
            'permission_admin_customers', 'permission_services', 'permission_manager_financial',
            'permission_other', 'permission_report', 'permission_other_setting'
        ])->each(function ($model) {
            $model->delete();
        });

        //===== dashboard
        AdminMenus::create([
            'name' => 'permission_dashboard',
            'route' => route('admin.index'),
            'icon' => '<i class="fa-solid fa-gauge"></i>'
        ]);

        //========== header
        $setting = AdminMenus::create([
            'name' => 'permission_main',
            'type' => AdminMenus::TYPE_HEADER
        ]);

        //===== admin
        $admin = AdminMenus::create([
            'name' => 'permission_manager_admin',
            'icon' => '<i class="fa-solid fa-user-group"></i>',
        ]);
        AdminMenus::create([
            'name' => 'permission_admins',
            'route' => route('admin.admins.index'),
            'parent_id' => $admin->id,
            'extension' => 'admins',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_permissions',
            'route' => route('admin.permissions.index'),
            'parent_id' => $admin->id,
            'extension' => 'admin_permissions',
        ]);

        //===== customer
        $customer = AdminMenus::create([
            'name' => 'permission_admin_customers',
            'icon' => '<i class="fa-solid fa-circle-user"></i>'
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_customers',
            'route' => route('admin.customers.index'),
            'parent_id' => $customer->id,
            'extension' => 'admin_customers',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_contacts',
            'route' => route('admin.contacts.index'),
            'parent_id' => $customer->id,
            'extension' => 'admin_contacts',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_leads',
            'route' => route('admin.leads.index'),
            'parent_id' => $customer->id,
            'extension' => 'admin_leads',
        ]);

        //===== services
        AdminMenus::create([
            'name' => 'permission_services',
            'icon' => '<i class="fa-solid fa-box"></i>',
            'route' => route('admin.services.index'),
        ]);

        //===== financial
        $financial = AdminMenus::create([
            'name' => 'permission_manager_financial',
            'icon' => '<i class="fa-solid fa-sack-dollar"></i>'
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_orders',
            'route' => route('admin.orders.index'),
            'parent_id' => $financial->id,
            'extension' => 'admin_orders',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_payments',
            'route' => route('admin.payments.index'),
            'parent_id' => $financial->id,
            'extension' => 'admin_payments',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_method_payments',
            'route' => route('admin.method_payments.index'),
            'parent_id' => $financial->id,
            'extension' => 'admin_method_payments',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_payment_portals',
            'route' => route('admin.payment_portals.index'),
            'parent_id' => $financial->id,
            'extension' => 'admin_payment_portals',
        ]);
        AdminMenus::create([
            'name' => 'permission_invoice_portals',
            'route' => route('admin.invoice_portals.index'),
            'parent_id' => $financial->id,
            'extension' => 'invoice_portals',
        ]);

        //========= header
        $setting = AdminMenus::create([
            'name' => 'permission_other',
            'type' => AdminMenus::TYPE_HEADER
        ]);

        //===== report
        $report = AdminMenus::create([
            'name' => 'permission_report',
            'icon' => '<i class="fa-solid fa-chart-simple"></i>'
        ]);
        AdminMenus::create([
            'name' => 'permission_report_revenue',
            'route' => route('admin.report.revenue'),
            'parent_id' => $report->id,
            'extension' => 'admin_orders',
        ]);
        AdminMenus::create([
            'name' => 'permission_report_financial',
            'route' => route('admin.report.financial'),
            'parent_id' => $report->id,
            'extension' => 'admin_payments',
        ]);
        AdminMenus::create([
            'name' => 'permission_report_invoice',
            'route' => route('admin.report.invoice'),
            'parent_id' => $report->id,
            'extension' => 'invoices',
        ]);
        AdminMenus::create([
            'name' => 'permission_report_register',
            'route' => route('admin.report.register'),
            'parent_id' => $report->id,
            'extension' => 'register_usings',
        ]);

        //===== setting
        $setting = AdminMenus::create([
            'name' => 'permission_other_setting',
            'icon' => '<i class="fa-solid fa-screwdriver-wrench"></i>'
        ]);
        AdminMenus::create([
            'name' => 'permission_provinces',
            'route' => route('admin.provinces.index'),
            'parent_id' => $setting->id,
            'extension' => 'provinces',
        ]);
        AdminMenus::create([
            'name' => 'permission_backup_dbs',
            'route' => route('admin.backups.index'),
            'parent_id' => $setting->id,
            'extension' => 'backup_dbs',
        ]);
        AdminMenus::create([
            'name' => 'permission_posts',
            'route' => route('admin.posts.index'),
            'parent_id' => $setting->id,
            'extension' => 'posts',
        ]);
        AdminMenus::create([
            'name' => 'permission_telescope',
            'route' => route('admin.telescope.index'),
            'parent_id' => $setting->id,
            'extension' => 'telescope',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_emails',
            'route' => route('admin.email_settings.index'),
            'parent_id' => $setting->id,
            'extension' => 'admin_emails',
        ]);
        AdminMenus::create([
            'name' => 'permission_admin_settings',
            'route' => route('admin.settings.index'),
            'parent_id' => $setting->id,
            'extension' => 'admin_settings',
        ]);
    }
}
