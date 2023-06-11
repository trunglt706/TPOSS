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
use Modules\Partners\Http\Controllers\Admins\DomainController;
use Modules\Partners\Http\Controllers\Admins\HistoryController;
use Modules\Partners\Http\Controllers\Admins\LicenseController;
use Modules\Partners\Http\Controllers\Admins\NotifyController;
use Modules\Partners\Http\Controllers\Admins\PartnerController;

Route::domain('admin.' . env('APP_URL'))->name('admin.')->group(function () {
    Route::middleware('checkAdmin')->group(function () {
        Route::prefix('partners')->controller(PartnerController::class)->name('partners.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'list')->name('list');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/{id}', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('partner_domains')->controller(DomainController::class)->name('partner_domains.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'list')->name('list');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/{id}', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('partner_histories')->controller(HistoryController::class)->name('partner_histories.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'list')->name('list');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/{id}', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('partner_notifies')->controller(NotifyController::class)->name('partner_notifies.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'list')->name('list');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/{id}', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });

        Route::prefix('partner_licenses')->controller(LicenseController::class)->name('partner_licenses.')->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'list')->name('list');
            Route::get('/{id}', 'detail')->where('id', '[0-9]+')->name('detail');
            Route::post('/{id}', 'store')->where('id', '[0-9]+')->name('store');
            Route::put('/{id}', 'update')->where('id', '[0-9]+')->name('update');
            Route::delete('/{id}', 'destroy')->where('id', '[0-9]+')->name('destroy');
        });
    });
});
