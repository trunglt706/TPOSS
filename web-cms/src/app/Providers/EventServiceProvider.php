<?php

namespace App\Providers;

use App\Models\PasswordResetToken;
use App\Observers\AdminAreaObserver;
use App\Observers\AdminBackupDBObserver;
use App\Observers\AdminBlockVendorObserver;
use App\Observers\AdminContactObserver;
use App\Observers\AdminCustomerObserver;
use App\Observers\AdminEmailObserver;
use App\Observers\AdminGroupObserver;
use App\Observers\AdminGroupRoleSampleObserver;
use App\Observers\AdminInvoiceObserver;
use App\Observers\AdminInvoicePortalObserver;
use App\Observers\AdminLeadObserver;
use App\Observers\AdminMenuObserver;
use App\Observers\AdminMethodPaymentObserver;
use App\Observers\AdminObserver;
use App\Observers\AdminPaymentObserver;
use App\Observers\AdminPaymentPortalObserver;
use App\Observers\AdminPermissionObserver;
use App\Observers\AdminPostGroupObserver;
use App\Observers\AdminPostObserver;
use App\Observers\AdminRegisterUsingObserver;
use App\Observers\AdminRoleDetailObserver;
use App\Observers\AdminRoleObserver;
use App\Observers\AdminServiceObserver;
use App\Observers\AdminSettingGroupObserver;
use App\Observers\AdminSettingObserver;
use App\Observers\AdminStoreFollowObserver;
use App\Observers\AdminTokenDeviceObserver;
use App\Observers\BusinessTypeObserver;
use App\Observers\PasswordResetTokenObserver;
use App\Observers\StoreObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Admins\Entities\AdminContact;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminEmails;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminGroupRoleSample;
use Modules\Admins\Entities\AdminInvoice;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminMethodPayment;
use Modules\Admins\Entities\AdminOrder;
use Modules\Admins\Entities\AdminPayment;
use Modules\Admins\Entities\AdminPaymentPortal;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminRole;
use Modules\Admins\Entities\AdminRoleDetail;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Entities\AdminServiceUsing;
use Modules\Admins\Entities\AdminServiceUsingStore;
use Modules\Admins\Entities\AdminSetting;
use Modules\Admins\Entities\AdminSettingGroup;
use Modules\Admins\Entities\AdminStoreFollow;
use Modules\Admins\Entities\AdminTokenDevice;
use Modules\Admins\Entities\Area;
use Modules\Admins\Entities\BackupDB;
use Modules\Admins\Entities\BlockVendor;
use Modules\Admins\Entities\BusinessType;
use Modules\Admins\Entities\InvoicePortal;
use Modules\Admins\Entities\PostGroup;
use Modules\Admins\Entities\Posts;
use Modules\Admins\Entities\RegisterUsing;
use Modules\Services\Entities\Services;
use Modules\Stores\Entities\Stores;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Admins::observe(new AdminObserver);
        Area::observe(new AdminAreaObserver);
        BackupDB::observe(new AdminBackupDBObserver);
        AdminContact::observe(new AdminContactObserver);
        BlockVendor::observe(new AdminBlockVendorObserver);
        AdminContact::observe(new AdminContactObserver);
        AdminEmails::observe(new AdminEmailObserver);
        AdminGroup::observe(new AdminGroupObserver);
        AdminCustomer::observe(new AdminCustomerObserver);
        AdminGroupRoleSample::observe(new AdminGroupRoleSampleObserver);
        AdminInvoice::observe(new AdminInvoiceObserver);
        InvoicePortal::observe(new AdminInvoicePortalObserver);
        AdminLead::observe(new AdminLeadObserver);
        AdminMethodPayment::observe(new AdminMethodPaymentObserver);
        AdminOrder::observe(new AdminObserver);
        AdminPayment::observe(new AdminPaymentObserver);
        AdminPaymentPortal::observe(new AdminPaymentPortalObserver);
        AdminPermission::observe(new AdminPermissionObserver);
        PostGroup::observe(new AdminPostGroupObserver);
        Posts::observe(new AdminPostObserver);
        RegisterUsing::observe(new AdminRegisterUsingObserver);
        AdminRoleDetail::observe(new AdminRoleDetailObserver);
        AdminRole::observe(new AdminRoleObserver);
        Services::observe(new AdminServiceObserver);
        AdminSettingGroup::observe(new AdminSettingGroupObserver);
        AdminSetting::observe(new AdminSettingObserver);
        AdminStoreFollow::observe(new AdminStoreFollowObserver);
        AdminServiceUsing::observe(new AdminServiceUsingStore());
        AdminTokenDevice::observe(new AdminTokenDeviceObserver);
        BusinessType::observe(new BusinessTypeObserver);
        Stores::observe(new StoreObserver);
        PasswordResetToken::observe(new PasswordResetTokenObserver);
        AdminMenus::observe(new AdminMenuObserver);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
