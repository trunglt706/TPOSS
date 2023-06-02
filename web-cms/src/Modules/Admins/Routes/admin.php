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
use Modules\Admins\Entities\InvoicePortal;
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
use Modules\Admins\Http\Controllers\LeadController;
use Modules\Admins\Http\Controllers\MethodPaymentController;
use Modules\Admins\Http\Controllers\NotifyController;
use Modules\Admins\Http\Controllers\OrderController;
use Modules\Admins\Http\Controllers\PaymentController;
use Modules\Admins\Http\Controllers\PaymentPortalController;
use Modules\Admins\Http\Controllers\PermissionController;
use Modules\Admins\Http\Controllers\PostController;
use Modules\Admins\Http\Controllers\PostGroupController;
use Modules\Admins\Http\Controllers\ProvinceController;
use Modules\Admins\Http\Controllers\RegisterUsingController;
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

        Route::prefix('admins')->group(function () {
            Route::get('', [AdminsController::class, 'index'])->name('admins.index');
        });

        Route::prefix('admin_groups')->group(function () {
            Route::get('', [AdminGroupController::class, 'index'])->name('admin_groups.index');
        });

        Route::prefix('admin_groups')->group(function () {
            Route::get('', [AdminGroupController::class, 'index'])->name('admin_groups.index');
        });

        Route::prefix('settings')->group(function () {
            Route::get('', [Setting::class, 'index'])->name('settings.index');
        });

        Route::prefix('settings')->group(function () {
            Route::get('', [SettingController::class, 'index'])->name('settings.index');
        });

        Route::prefix('setting_groups')->group(function () {
            Route::get('', [SettingGroupController::class, 'index'])->name('setting_groups.index');
        });

        Route::prefix('ares')->group(function () {
            Route::get('', [AreaController::class, 'index'])->name('ares.index');
        });

        Route::prefix('provinces')->group(function () {
            Route::get('', [ProvinceController::class, 'index'])->name('provinces.index');
        });

        Route::prefix('districts')->group(function () {
            Route::get('', [DistrictController::class, 'index'])->name('districts.index');
        });

        Route::prefix('wards')->group(function () {
            Route::get('', [WardController::class, 'index'])->name('wards.index');
        });

        Route::prefix('backups')->group(function () {
            Route::get('', [BackupController::class, 'index'])->name('backups.index');
        });

        Route::prefix('block_vendors')->group(function () {
            Route::get('', [BlockVendorController::class, 'index'])->name('block_vendors.index');
        });

        Route::prefix('customers')->group(function () {
            Route::get('', [CustomerController::class, 'index'])->name('customers.index');
        });

        Route::prefix('contacts')->group(function () {
            Route::get('', [ContactController::class, 'index'])->name('contacts.index');
        });

        Route::prefix('leads')->group(function () {
            Route::get('', [LeadController::class, 'index'])->name('leads.index');
        });

        Route::prefix('email_settings')->group(function () {
            Route::get('', [EmailSettingController::class, 'index'])->name('email_settings.index');
        });

        Route::prefix('invoices')->group(function () {
            Route::get('', [InvoiceController::class, 'index'])->name('invoices.index');
        });

        Route::prefix('invoice_portals')->group(function () {
            Route::get('', [InvoicePortal::class, 'index'])->name('invoice_portals.index');
        });

        Route::prefix('method_payments')->group(function () {
            Route::get('', [MethodPaymentController::class, 'index'])->name('method_payments.index');
        });

        Route::prefix('notifications')->group(function () {
            Route::get('', [NotifyController::class, 'index'])->name('notifications.index');
        });

        Route::prefix('orders')->group(function () {
            Route::get('', [OrderController::class, 'index'])->name('orders.index');
        });

        Route::prefix('payments')->group(function () {
            Route::get('', [PaymentController::class, 'index'])->name('payments.index');
        });

        Route::prefix('payment_portals')->group(function () {
            Route::get('', [PaymentPortalController::class, 'index'])->name('payment_portals.index');
        });

        Route::prefix('permissions')->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('permissions.index');
        });

        Route::prefix('roles')->group(function () {
            Route::get('', [RoleController::class, 'index'])->name('roles.index');
        });

        Route::prefix('posts')->group(function () {
            Route::get('', [PostController::class, 'index'])->name('posts.index');
        });

        Route::prefix('post_groups')->group(function () {
            Route::get('', [PostGroupController::class, 'index'])->name('post_groups.index');
        });

        Route::prefix('register_usings')->group(function () {
            Route::get('', [RegisterUsingController::class, 'index'])->name('register_usings.index');
        });

        Route::prefix('services')->group(function () {
            Route::get('', [ServiceController::class, 'index'])->name('services.index');
        });
    });
});
