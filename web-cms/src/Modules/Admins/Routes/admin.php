<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Admins\Http\Controllers\ActivityController;
use Modules\Admins\Http\Controllers\AdminGroupController;
use Modules\Admins\Http\Controllers\AdminsController;
use Modules\Admins\Http\Controllers\AreaController;
use Modules\Admins\Http\Controllers\AuthController;
use Modules\Admins\Http\Controllers\BackupController;
use Modules\Admins\Http\Controllers\BlockVendorController;
use Modules\Admins\Http\Controllers\ContactController;
use Modules\Admins\Http\Controllers\CustomerController;
use Modules\Admins\Http\Controllers\DistrictController;
use Modules\Admins\Http\Controllers\EmailSettingController;
use Modules\Admins\Http\Controllers\HomeController;
use Modules\Admins\Http\Controllers\InvoiceController;
use Modules\Admins\Http\Controllers\InvoicePortalController;
use Modules\Admins\Http\Controllers\LeadController;
use Modules\Admins\Http\Controllers\MethodPaymentController;
use Modules\Admins\Http\Controllers\NotifyController;
use Modules\Admins\Http\Controllers\OrderController;
use Modules\Admins\Http\Controllers\PaymentController;
use Modules\Admins\Http\Controllers\PaymentPortalController;
use Modules\Admins\Http\Controllers\PermissionController;
use Modules\Admins\Http\Controllers\PostController;
use Modules\Admins\Http\Controllers\PostGroupController;
use Modules\Admins\Http\Controllers\ProfileController;
use Modules\Admins\Http\Controllers\ProvinceController;
use Modules\Admins\Http\Controllers\RegisterUsingController;
use Modules\Admins\Http\Controllers\ReportController;
use Modules\Admins\Http\Controllers\RoleController;
use Modules\Admins\Http\Controllers\ServiceController;
use Modules\Admins\Http\Controllers\SettingController;
use Modules\Admins\Http\Controllers\SettingGroupController;
use Modules\Admins\Http\Controllers\WardController;

Route::domain('admin.' . env('APP_URL'))->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::get('forgot_password', [AuthController::class, 'forgot_password'])->name('forgot_password');
        Route::get('reset_password', [AuthController::class, 'reset_password'])->name('reset_password');
    });

    Route::middleware('guest')->group(function () {
        Route::get('', [HomeController::class, 'index'])->name('index');
        Route::get('logout', [HomeController::class, 'logout'])->name('logout');

        Route::prefix('profile')->group(function () {
            Route::get('', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('info', [ProfileController::class, 'info'])->name('profile.info');
            Route::post('account', [ProfileController::class, 'account'])->name('profile.account');
        });

        Route::prefix('admins')->group(function () {
            Route::get('', [AdminsController::class, 'index'])->name('admins.index');
            Route::post('', [AdminsController::class, 'list'])->name('admins.list');
            Route::get('/{id}', [AdminsController::class, 'detail'])->where('id', '[0-9]+')->name('admins.detail');
            Route::post('/{id}', [AdminsController::class, 'store'])->where('id', '[0-9]+')->name('admins.store');
            Route::put('/{id}', [AdminsController::class, 'update'])->where('id', '[0-9]+')->name('admins.update');
            Route::delete('/{id}', [AdminsController::class, 'destroy'])->where('id', '[0-9]+')->name('admins.destroy');
        });

        Route::prefix('activities')->group(function () {
            Route::get('', [ActivityController::class, 'index'])->name('activities.index');
            Route::post('', [ActivityController::class, 'list'])->name('activities.list');
            Route::get('/{id}', [ActivityController::class, 'detail'])->where('id', '[0-9]+')->name('activities.detail');
        });

        Route::prefix('admin_groups')->group(function () {
            Route::get('', [AdminGroupController::class, 'index'])->name('admin_groups.index');
            Route::get('/{id}', [AdminGroupController::class, 'detail'])->where('id', '[0-9]+')->where('id', '[0-9]+')->name('admin_groups.detail');
            Route::post('/{id}', [AdminGroupController::class, 'store'])->where('id', '[0-9]+')->name('admin_groups.store');
            Route::put('/{id}', [AdminGroupController::class, 'update'])->where('id', '[0-9]+')->name('admin_groups.update');
            Route::delete('/{id}', [AdminGroupController::class, 'destroy'])->where('id', '[0-9]+')->name('admin_groups.destroy');
        });

        Route::prefix('settings')->group(function () {
            Route::get('', [SettingController::class, 'index'])->name('settings.index');
            Route::get('/{id}', [SettingController::class, 'detail'])->where('id', '[0-9]+')->name('settings.detail');
            Route::put('/{id}', [SettingController::class, 'update'])->where('id', '[0-9]+')->name('settings.update');
        });

        Route::prefix('setting_groups')->group(function () {
            Route::get('', [SettingGroupController::class, 'index'])->name('setting_groups.index');
            Route::get('/{id}', [SettingGroupController::class, 'detail'])->where('id', '[0-9]+')->name('setting_groups.detail');
            Route::put('/{id}', [SettingGroupController::class, 'update'])->where('id', '[0-9]+')->name('setting_groups.update');
        });

        Route::prefix('ares')->group(function () {
            Route::get('', [AreaController::class, 'index'])->name('ares.index');
            Route::get('/{id}', [AreaController::class, 'detail'])->where('id', '[0-9]+')->name('ares.detail');
            Route::post('/{id}', [AreaController::class, 'store'])->where('id', '[0-9]+')->name('ares.store');
            Route::put('/{id}', [AreaController::class, 'update'])->where('id', '[0-9]+')->name('ares.update');
            Route::delete('/{id}', [AreaController::class, 'destroy'])->where('id', '[0-9]+')->name('ares.destroy');
        });

        Route::prefix('provinces')->group(function () {
            Route::get('', [ProvinceController::class, 'index'])->name('provinces.index');
            Route::get('/{id}', [ProvinceController::class, 'detail'])->where('id', '[0-9]+')->name('provinces.detail');
            Route::post('/{id}', [ProvinceController::class, 'store'])->where('id', '[0-9]+')->name('provinces.store');
            Route::put('/{id}', [ProvinceController::class, 'update'])->name('provinces.update');
            Route::delete('/{id}', [ProvinceController::class, 'destroy'])->where('id', '[0-9]+')->name('provinces.destroy');
        });

        Route::prefix('districts')->group(function () {
            Route::get('', [DistrictController::class, 'index'])->name('districts.index');
            Route::get('/{id}', [DistrictController::class, 'detail'])->where('id', '[0-9]+')->name('districts.detail');
            Route::post('/{id}', [DistrictController::class, 'store'])->where('id', '[0-9]+')->name('districts.store');
            Route::put('/{id}', [DistrictController::class, 'update'])->where('id', '[0-9]+')->name('districts.update');
            Route::delete('/{id}', [DistrictController::class, 'destroy'])->where('id', '[0-9]+')->name('districts.destroy');
        });

        Route::prefix('wards')->group(function () {
            Route::get('', [WardController::class, 'index'])->name('wards.index');
            Route::get('/{id}', [WardController::class, 'detail'])->where('id', '[0-9]+')->name('wards.detail');
            Route::post('/{id}', [WardController::class, 'store'])->where('id', '[0-9]+')->name('wards.store');
            Route::put('/{id}', [WardController::class, 'update'])->where('id', '[0-9]+')->name('wards.update');
            Route::delete('/{id}', [WardController::class, 'destroy'])->where('id', '[0-9]+')->name('wards.destroy');
        });

        Route::prefix('backups')->group(function () {
            Route::get('', [BackupController::class, 'index'])->name('backups.index');
            Route::get('/{id}', [BackupController::class, 'detail'])->where('id', '[0-9]+')->name('backups.detail');
            Route::post('/{id}', [BackupController::class, 'store'])->where('id', '[0-9]+')->name('backups.store');
            Route::put('/{id}', [BackupController::class, 'update'])->where('id', '[0-9]+')->name('backups.update');
            Route::delete('/{id}', [BackupController::class, 'destroy'])->where('id', '[0-9]+')->name('backups.destroy');
        });

        Route::prefix('block_vendors')->group(function () {
            Route::get('', [BlockVendorController::class, 'index'])->name('block_vendors.index');
            Route::get('/{id}', [BlockVendorController::class, 'detail'])->where('id', '[0-9]+')->name('block_vendors.detail');
            Route::post('/{id}', [BlockVendorController::class, 'store'])->where('id', '[0-9]+')->name('block_vendors.store');
            Route::put('/{id}', [BlockVendorController::class, 'update'])->where('id', '[0-9]+')->name('block_vendors.update');
            Route::delete('/{id}', [BlockVendorController::class, 'destroy'])->where('id', '[0-9]+')->name('block_vendors.destroy');
        });

        Route::prefix('customers')->group(function () {
            Route::get('', [CustomerController::class, 'index'])->name('customers.index');
            Route::get('/{id}', [CustomerController::class, 'detail'])->where('id', '[0-9]+')->name('customers.detail');
            Route::post('/{id}', [CustomerController::class, 'store'])->where('id', '[0-9]+')->name('customers.store');
            Route::put('/{id}', [CustomerController::class, 'update'])->where('id', '[0-9]+')->name('customers.update');
            Route::delete('/{id}', [CustomerController::class, 'destroy'])->where('id', '[0-9]+')->name('customers.destroy');
        });

        Route::prefix('contacts')->group(function () {
            Route::get('', [ContactController::class, 'index'])->name('contacts.index');
            Route::get('/{id}', [ContactController::class, 'detail'])->where('id', '[0-9]+')->name('contacts.detail');
            Route::post('/{id}', [ContactController::class, 'store'])->where('id', '[0-9]+')->name('contacts.store');
            Route::put('/{id}', [ContactController::class, 'update'])->where('id', '[0-9]+')->name('contacts.update');
            Route::delete('/{id}', [ContactController::class, 'destroy'])->where('id', '[0-9]+')->name('contacts.destroy');
        });

        Route::prefix('leads')->group(function () {
            Route::get('', [LeadController::class, 'index'])->name('leads.index');
            Route::get('/{id}', [LeadController::class, 'detail'])->where('id', '[0-9]+')->name('leads.detail');
            Route::post('/{id}', [LeadController::class, 'store'])->where('id', '[0-9]+')->name('leads.store');
            Route::put('/{id}', [LeadController::class, 'update'])->where('id', '[0-9]+')->name('leads.update');
            Route::delete('/{id}', [LeadController::class, 'destroy'])->where('id', '[0-9]+')->name('leads.destroy');
        });

        Route::prefix('email_settings')->group(function () {
            Route::get('', [EmailSettingController::class, 'index'])->name('email_settings.index');
            Route::get('/{id}', [EmailSettingController::class, 'detail'])->where('id', '[0-9]+')->name('email_settings.detail');
            Route::put('/{id}', [EmailSettingController::class, 'update'])->where('id', '[0-9]+')->name('email_settings.update');
        });

        Route::prefix('invoices')->group(function () {
            Route::get('', [InvoiceController::class, 'index'])->name('invoices.index');
            Route::get('/{id}', [InvoiceController::class, 'detail'])->where('id', '[0-9]+')->name('invoices.detail');
            Route::post('/{id}', [InvoiceController::class, 'store'])->where('id', '[0-9]+')->name('invoices.store');
            Route::put('/{id}', [InvoiceController::class, 'update'])->where('id', '[0-9]+')->name('invoices.update');
            Route::delete('/{id}', [InvoiceController::class, 'destroy'])->where('id', '[0-9]+')->name('invoices.destroy');
        });

        Route::prefix('invoice_portals')->group(function () {
            Route::get('', [InvoicePortalController::class, 'index'])->name('invoice_portals.index');
            Route::get('/{id}', [InvoicePortalController::class, 'detail'])->where('id', '[0-9]+')->name('invoice_portals.detail');
            Route::post('/{id}', [InvoicePortalController::class, 'store'])->where('id', '[0-9]+')->name('invoice_portals.store');
            Route::put('/{id}', [InvoicePortalController::class, 'update'])->where('id', '[0-9]+')->name('invoice_portals.update');
            Route::delete('/{id}', [AdminsInvoicePortalControllerController::class, 'destroy'])->where('id', '[0-9]+')->name('invoice_portals.destroy');
        });

        Route::prefix('method_payments')->group(function () {
            Route::get('', [MethodPaymentController::class, 'index'])->name('method_payments.index');
            Route::get('/{id}', [MethodPaymentController::class, 'detail'])->where('id', '[0-9]+')->name('method_payments.detail');
            Route::post('/{id}', [MethodPaymentController::class, 'store'])->where('id', '[0-9]+')->name('method_payments.store');
            Route::put('/{id}', [MethodPaymentController::class, 'update'])->where('id', '[0-9]+')->name('method_payments.update');
            Route::delete('/{id}', [MethodPaymentController::class, 'destroy'])->where('id', '[0-9]+')->name('method_payments.destroy');
        });

        Route::prefix('notifications')->group(function () {
            Route::get('', [NotifyController::class, 'index'])->name('notifications.index');
            Route::get('/{id}', [NotifyController::class, 'detail'])->where('id', '[0-9]+')->name('notifications.detail');
            Route::delete('/{id}', [NotifyController::class, 'destroy'])->where('id', '[0-9]+')->name('notifications.destroy');
        });

        Route::prefix('orders')->group(function () {
            Route::get('', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/{id}', [OrderController::class, 'detail'])->where('id', '[0-9]+')->name('orders.detail');
            Route::post('/{id}', [OrderController::class, 'store'])->where('id', '[0-9]+')->name('orders.store');
            Route::put('/{id}', [OrderController::class, 'update'])->where('id', '[0-9]+')->name('orders.update');
            Route::delete('/{id}', [OrderController::class, 'destroy'])->where('id', '[0-9]+')->name('orders.destroy');
        });

        Route::prefix('payments')->group(function () {
            Route::get('', [PaymentController::class, 'index'])->name('payments.index');
            Route::get('/{id}', [PaymentController::class, 'detail'])->where('id', '[0-9]+')->name('payments.detail');
            Route::post('/{id}', [PaymentController::class, 'store'])->where('id', '[0-9]+')->name('payments.store');
            Route::put('/{id}', [PaymentController::class, 'update'])->where('id', '[0-9]+')->name('payments.update');
            Route::delete('/{id}', [PaymentController::class, 'destroy'])->where('id', '[0-9]+')->name('payments.destroy');
        });

        Route::prefix('payment_portals')->group(function () {
            Route::get('', [PaymentPortalController::class, 'index'])->name('payment_portals.index');
            Route::get('/{id}', [PaymentPortalController::class, 'detail'])->where('id', '[0-9]+')->name('payment_portals.detail');
            Route::post('/{id}', [PaymentPortalController::class, 'store'])->where('id', '[0-9]+')->name('payment_portals.store');
            Route::put('/{id}', [PaymentPortalController::class, 'update'])->where('id', '[0-9]+')->name('payment_portals.update');
            Route::delete('/{id}', [PaymentPortalController::class, 'destroy'])->where('id', '[0-9]+')->name('payment_portals.destroy');
        });

        Route::prefix('permissions')->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('permissions.index');
            Route::get('/{id}', [PermissionController::class, 'detail'])->where('id', '[0-9]+')->name('permissions.detail');
            Route::post('/{id}', [PermissionController::class, 'store'])->where('id', '[0-9]+')->name('permissions.store');
            Route::put('/{id}', [PermissionController::class, 'update'])->where('id', '[0-9]+')->name('permissions.update');
            Route::delete('/{id}', [PermissionController::class, 'destroy'])->where('id', '[0-9]+')->name('permissions.destroy');
        });

        Route::prefix('roles')->group(function () {
            Route::get('', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/{id}', [RoleController::class, 'detail'])->where('id', '[0-9]+')->name('roles.detail');
            Route::post('/{id}', [RoleController::class, 'store'])->where('id', '[0-9]+')->name('roles.store');
            Route::put('/{id}', [RoleController::class, 'update'])->where('id', '[0-9]+')->name('roles.update');
            Route::delete('/{id}', [RoleController::class, 'destroy'])->where('id', '[0-9]+')->name('roles.destroy');
        });

        Route::prefix('posts')->group(function () {
            Route::get('', [PostController::class, 'index'])->name('posts.index');
            Route::get('/{id}', [PostController::class, 'detail'])->where('id', '[0-9]+')->name('posts.detail');
            Route::post('/{id}', [PostController::class, 'store'])->where('id', '[0-9]+')->name('posts.store');
            Route::put('/{id}', [PostController::class, 'update'])->where('id', '[0-9]+')->name('posts.update');
            Route::delete('/{id}', [PostController::class, 'destroy'])->where('id', '[0-9]+')->name('posts.destroy');
        });

        Route::prefix('post_groups')->group(function () {
            Route::get('', [PostGroupController::class, 'index'])->name('post_groups.index');
            Route::get('/{id}', [PostGroupController::class, 'detail'])->where('id', '[0-9]+')->name('post_groups.detail');
            Route::post('/{id}', [PostGroupController::class, 'store'])->where('id', '[0-9]+')->name('post_groups.store');
            Route::put('/{id}', [PostGroupController::class, 'update'])->where('id', '[0-9]+')->name('post_groups.update');
            Route::delete('/{id}', [PostGroupController::class, 'destroy'])->where('id', '[0-9]+')->name('post_groups.destroy');
        });

        Route::prefix('register_usings')->group(function () {
            Route::get('', [RegisterUsingController::class, 'index'])->name('register_usings.index');
            Route::get('/{id}', [RegisterUsingController::class, 'detail'])->where('id', '[0-9]+')->name('register_usings.detail');
            Route::put('/{id}', [RegisterUsingController::class, 'update'])->where('id', '[0-9]+')->name('register_usings.update');
            Route::delete('/{id}', [RegisterUsingController::class, 'destroy'])->where('id', '[0-9]+')->name('register_usings.destroy');
        });

        Route::prefix('services')->group(function () {
            Route::get('', [ServiceController::class, 'index'])->name('services.index');
            Route::get('/{id}', [ServiceController::class, 'detail'])->where('id', '[0-9]+')->name('services.detail');
            Route::post('/{id}', [ServiceController::class, 'store'])->where('id', '[0-9]+')->name('services.store');
            Route::put('/{id}', [ServiceController::class, 'update'])->where('id', '[0-9]+')->name('services.update');
            Route::delete('/{id}', [ServiceController::class, 'destroy'])->where('id', '[0-9]+')->name('services.destroy');
        });

        Route::prefix('report')->group(function () {
            Route::get('revenue', [ReportController::class, 'revenue'])->name('report.revenue');
            Route::get('financial', [ReportController::class, 'financial'])->name('report.financial');
            Route::get('invoice', [ReportController::class, 'invoice'])->name('report.invoice');
            Route::get('register', [ReportController::class, 'register'])->name('report.register');
        });

        Route::get('telescope', [HomeController::class, 'telescope'])->name('telescope.index');
    });
});
