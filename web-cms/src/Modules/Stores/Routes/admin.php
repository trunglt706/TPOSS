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
use Modules\Stores\Http\Controllers\Admins\StoreController;

Route::domain('admin.' . env('APP_URL'))->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::prefix('stores')->group(function () {
            Route::get('', [StoreController::class, 'index'])->name('stores.index');
            Route::post('', [StoreController::class, 'list'])->name('stores.list');
            Route::get('/{id}', [StoreController::class, 'detail'])->where('id', '[0-9]+')->name('stores.detail');
            Route::post('/{id}', [StoreController::class, 'store'])->where('id', '[0-9]+')->name('stores.store');
            Route::put('/{id}', [StoreController::class, 'update'])->where('id', '[0-9]+')->name('stores.update');
            Route::delete('/{id}', [StoreController::class, 'destroy'])->where('id', '[0-9]+')->name('stores.destroy');
        });
    });
});
