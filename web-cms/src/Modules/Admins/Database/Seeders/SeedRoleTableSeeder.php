<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminRole;

class SeedRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminPermission::truncate();
        AdminRole::truncate();

        //======== admins
        $admins = AdminPermission::create([
            'name' => 'permission_admins',
            'extension' => 'admins',
            'icon' => 'user'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT, AdminRole::ROLE_PERMISSION] as $role) {
            AdminRole::create([
                'permission_id' => $admins->id,
                'extension' => $role
            ]);
        }

        //======== admin_groups
        $admin_groups = AdminPermission::create([
            'name' => 'permission_admin_groups',
            'extension' => 'admin_groups',
            'icon' => 'users'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_groups->id,
                'extension' => $role
            ]);
        }

        //======== admin_activities
        $admin_activities = AdminPermission::create([
            'name' => 'permission_admin_activities',
            'extension' => 'admin_activities',
            'icon' => 'clock'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_VIEW_OWNER, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_activities->id,
                'extension' => $role
            ]);
        }

        //======== admin_permissions
        $admin_permissions = AdminPermission::create([
            'name' => 'permission_admin_permissions',
            'extension' => 'admin_permissions',
            'icon' => 'check-circle'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $admin_permissions->id,
                'extension' => $role
            ]);
        }

        //======== admin_customers
        $admin_customers = AdminPermission::create([
            'name' => 'permission_admin_customers',
            'extension' => 'admin_customers',
            'icon' => 'user-plus'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_VIEW_OWNER, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_customers->id,
                'extension' => $role
            ]);
        }

        //======== admin_contacts
        $admin_contacts = AdminPermission::create([
            'name' => 'permission_admin_contacts',
            'extension' => 'admin_contacts',
            'icon' => 'user-minus'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $admin_contacts->id,
                'extension' => $role
            ]);
        }

        //======== admin_leads
        $admin_leads = AdminPermission::create([
            'name' => 'permission_admin_leads',
            'extension' => 'admin_leads',
            'icon' => 'user-check'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_VIEW_OWNER, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_leads->id,
                'extension' => $role
            ]);
        }

        //======== register_usings
        $register_usings = AdminPermission::create([
            'name' => 'permission_register_usings',
            'extension' => 'register_usings',
            'icon' => 'user-x'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $register_usings->id,
                'extension' => $role
            ]);
        }

        //======== stores
        $stores = AdminPermission::create([
            'name' => 'permission_stores',
            'extension' => 'stores',
            'icon' => 'home'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $stores->id,
                'extension' => $role
            ]);
        }

        //======== admin_orders
        $admin_orders = AdminPermission::create([
            'name' => 'permission_admin_orders',
            'extension' => 'admin_orders',
            'icon' => 'file'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_orders->id,
                'extension' => $role
            ]);
        }

        //======== admin_payments
        $admin_payments = AdminPermission::create([
            'name' => 'permission_admin_payments',
            'extension' => 'admin_payments',
            'icon' => 'dollar-sign'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_payments->id,
                'extension' => $role
            ]);
        }

        //======== admin_method_payments
        $admin_method_payments = AdminPermission::create([
            'name' => 'permission_admin_method_payments',
            'extension' => 'admin_method_payments',
            'icon' => 'slack'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_method_payments->id,
                'extension' => $role
            ]);
        }

        //======== admin_payment_portals
        $admin_payment_portals = AdminPermission::create([
            'name' => 'permission_admin_payment_portals',
            'extension' => 'admin_payment_portals',
            'icon' => 'shield'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $admin_payment_portals->id,
                'extension' => $role
            ]);
        }

        //======== invoice_portals
        $invoice_portals = AdminPermission::create([
            'name' => 'permission_invoice_portals',
            'extension' => 'invoice_portals',
            'icon' => 'pocket'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $invoice_portals->id,
                'extension' => $role
            ]);
        }

        //======== invoices
        $invoices = AdminPermission::create([
            'name' => 'permission_invoices',
            'extension' => 'invoices',
            'icon' => 'file-text'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $invoices->id,
                'extension' => $role
            ]);
        }

        //======== services
        $services = AdminPermission::create([
            'name' => 'permission_services',
            'extension' => 'services',
            'icon' => 'aperture'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT, AdminRole::ROLE_PERMISSION] as $role) {
            AdminRole::create([
                'permission_id' => $services->id,
                'extension' => $role
            ]);
        }

        //======== admin_areas
        $admin_areas = AdminPermission::create([
            'name' => 'permission_admin_areas',
            'extension' => 'admin_areas',
            'icon' => 'map-pin'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $admin_areas->id,
                'extension' => $role
            ]);
        }

        //======== provinces
        $provinces = AdminPermission::create([
            'name' => 'permission_provinces',
            'extension' => 'provinces',
            'icon' => 'map-pin'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $provinces->id,
                'extension' => $role
            ]);
        }

        //======== districts
        $districts = AdminPermission::create([
            'name' => 'permission_districts',
            'extension' => 'districts',
            'icon' => 'map-pin'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $districts->id,
                'extension' => $role
            ]);
        }

        //======== wards
        $wards = AdminPermission::create([
            'name' => 'permission_wards',
            'extension' => 'wards',
            'icon' => 'map-pin'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $wards->id,
                'extension' => $role
            ]);
        }

        //======== backup_dbs
        $backup_dbs = AdminPermission::create([
            'name' => 'permission_backup_dbs',
            'extension' => 'backup_dbs',
            'icon' => 'database'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $backup_dbs->id,
                'extension' => $role
            ]);
        }

        //======== post_groups
        $post_groups = AdminPermission::create([
            'name' => 'permission_post_groups',
            'extension' => 'post_groups',
            'icon' => 'bookmark'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $post_groups->id,
                'extension' => $role
            ]);
        }

        //======== posts
        $posts = AdminPermission::create([
            'name' => 'permission_posts',
            'extension' => 'posts',
            'icon' => 'post'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE, AdminRole::ROLE_REPORT] as $role) {
            AdminRole::create([
                'permission_id' => $posts->id,
                'extension' => $role
            ]);
        }

        //======== telescope
        $telescope = AdminPermission::create([
            'name' => 'permission_telescope',
            'extension' => 'telescope',
            'icon' => 'post'
        ]);
        foreach ([AdminRole::ROLE_VIEW] as $role) {
            AdminRole::create([
                'permission_id' => $telescope->id,
                'extension' => $role
            ]);
        }

        //======== 	admin_emails
        $admin_emails = AdminPermission::create([
            'name' => 'permission_admin_emails',
            'extension' => 'admin_emails',
            'icon' => 'mail'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_INSERT, AdminRole::ROLE_UPDATE, AdminRole::ROLE_DELETE] as $role) {
            AdminRole::create([
                'permission_id' => $admin_emails->id,
                'extension' => $role
            ]);
        }

        //======== 		admin_settings
        $admin_settings = AdminPermission::create([
            'name' => 'permission_admin_settings',
            'extension' => 'admin_settings',
            'icon' => 'settings'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_UPDATE] as $role) {
            AdminRole::create([
                'permission_id' => $admin_settings->id,
                'extension' => $role
            ]);
        }
    }
}
