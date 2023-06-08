<?php

use Illuminate\Support\Facades\Route;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Entities\AdminServiceUsing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::domain(env('APP_URL'))->group(function () {
    Route::get('/', function () {
        $a = Admins::doesnthave('group')->toSql();
        dd($a); // Show results of log
        return view('welcome');
    });
});
