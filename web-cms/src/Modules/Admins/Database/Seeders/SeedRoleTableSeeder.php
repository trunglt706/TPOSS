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
            'icon' => '<i class="fa-solid fa-user-group"></i>'
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
            'icon' => '<i class="fa-solid fa-users-line"></i>'
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
            'icon' => '<i class="fa-solid fa-clock-rotate-left"></i>'
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
            'icon' => '<i class="fa-solid fa-circle-check"></i>'
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
            'icon' => '<i class="fa-solid fa-circle-user"></i>'
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
            'icon' => '<i class="fa-solid fa-user-minus"></i>'
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
            'icon' => '<i class="fa-solid fa-user-check"></i>'
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
            'icon' => '<i class="fa-solid fa-user-xmark"></i>'
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
            'icon' => '<i class="fa-solid fa-store"></i>'
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
            'icon' => '<i class="fa-solid fa-file"></i>'
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
            'icon' => '<i class="fa-solid fa-dollar-sign"></i>'
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
            'icon' => '<i class="fa-solid fa-layer-group"></i>'
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
            'icon' => '<i class="fa-solid fa-shield"></i>'
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
            'icon' => '<i class="fa-brands fa-first-order"></i>'
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
            'icon' => '<i class="fa-solid fa-file-lines"></i>'
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
            'icon' => '<i class="fa-solid fa-explosion"></i>'
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
            'icon' => '<i class="fa-solid fa-earth-americas"></i>'
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
            'icon' => '<i class="fa-solid fa-map-pin"></i>'
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
            'icon' => '<i class="fa-solid fa-location-dot"></i>'
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
            'icon' => '<i class="fa-solid fa-street-view"></i>'
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
            'icon' => '<i class="fa-solid fa-database"></i>'
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
            'icon' => '<i class="fa-solid fa-bookmark"></i>'
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
            'icon' => '<i class="fa-solid fa-book-bookmark"></i>'
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
            'icon' => '<i class="fa-solid fa-computer"></i>'
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
            'icon' => '<i class="fa-solid fa-envelope-circle-check"></i>'
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
            'icon' => '<i class="fa-solid fa-screwdriver-wrench"></i>'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_UPDATE] as $role) {
            AdminRole::create([
                'permission_id' => $admin_settings->id,
                'extension' => $role
            ]);
        }

        //======== 		other
        $other = AdminPermission::create([
            'name' => 'permission_other',
            'extension' => 'other',
            'icon' => '<i class="fa-brands fa-slack"></i>'
        ]);
        foreach ([AdminRole::ROLE_VIEW, AdminRole::ROLE_UPDATE] as $role) {
            AdminRole::create([
                'permission_id' => $other->id,
                'extension' => $role
            ]);
        }
    }
}
