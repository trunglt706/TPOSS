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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->controller(AuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'login_post')->name('login_post');
        Route::get('forgot_password', 'forgot_password')->name('forgot_password');
        Route::post('forgot_password', 'forgot_password_post')->name('forgot_password_post');
        Route::get('reset_password', 'reset_password')->name('reset_password');
        Route::post('reset_password', 'reset_password_post')->name('reset_password_post');
        Route::get('language/{lang}', 'change_language')->name('change_language');
        Route::get('otp', 'otp')->name('otp');
        Route::post('otp', 'otp_post')->name('otp_post');
    });

    Route::middleware('checkAdmin')->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('logout', 'logout')->name('logout');
            Route::get('telescope', 'telescope')->name('telescope.index');
            Route::post('home_header', 'home_header')->name('home_header');
            Route::post('home_activity', 'home_activity')->name('home_activity');
            Route::post('home_revenue', 'home_revenue')->name('home_revenue');
            Route::post('home_register', 'home_register')->name('home_register');
            Route::post('home_leads', 'home_leads')->name('home_leads');
            Route::get('global/{type}', 'global')->name('global');
        });

        Route::prefix('profile')->controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('info', 'info')->name('info');
            Route::post('account', 'account')->name('account');
        });

        Route::prefix('admins')->controller(AdminsController::class)->name('admins.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'list')->name('list');
            Route::post('/assigned', 'assigned')->where('id', '[0-9]+')->name('assigned');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::post('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('activities')->controller(ActivityController::class)->name('activities.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'list')->name('list');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
        });

        Route::prefix('admin_groups')->controller(AdminGroupController::class)->name('admin_groups.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('settings')->controller(SettingController::class)->name('settings.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
        });

        Route::prefix('setting_groups')->controller(SettingGroupController::class)->name('setting_groups.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
        });

        Route::prefix('ares')->controller(AreaController::class)->name('ares.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('provinces')->controller(ProvinceController::class)->name('provinces.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('districts')->controller(DistrictController::class)->name('districts.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('wards')->controller(WardController::class)->name('wards.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('backups')->controller(BackupController::class)->name('backups.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('block_vendors')->controller(BlockVendorController::class)->name('block_vendors.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('customers')->controller(CustomerController::class)->name('admin_customers.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('contacts')->controller(ContactController::class)->name('admin_contacts.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('leads')->controller(LeadController::class)->name('admin_leads.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('email_settings')->controller(EmailSettingController::class)->name('admin_emails.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
        });

        Route::prefix('invoices')->controller(InvoiceController::class)->name('admin_invoices.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('invoice_portals')->controller(InvoicePortalController::class)->name('invoice_portals.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('method_payments')->controller(MethodPaymentController::class)->name('admin_method_payments.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('notifications')->controller(NotifyController::class)->name('admin_notifications.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('orders')->controller(OrderController::class)->name('admin_orders.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('payments')->controller(PaymentController::class)->name('admin_payments.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('payment_portals')->controller(PaymentPortalController::class)->name('admin_payment_portals.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('permissions')->controller(PermissionController::class)->name('admin_permissions.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('roles')->controller(RoleController::class)->name('admin_roles.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('posts')->controller(PostController::class)->name('posts.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('post_groups')->controller(PostGroupController::class)->name('post_groups.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('register_usings')->controller(RegisterUsingController::class)->name('register_usings.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('services')->controller(ServiceController::class)->name('services.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/store', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('report')->controller(ReportController::class)->name('report.')->group(function () {
            Route::get('revenue', 'revenue')->name('revenue');
            Route::get('financial', 'financial')->name('financial');
            Route::get('invoice', 'invoice')->name('invoice');
            Route::get('register', 'register')->name('register');
        });
    });
});
