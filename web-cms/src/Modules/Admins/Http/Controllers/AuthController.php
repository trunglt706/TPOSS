<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\AdminSetting;

class AuthController extends Controller
{
    public function login()
    {
        return AdminSetting::with('permission')->get();
        $title = __('login');
        return view('admins::admins.pages.auth.login', compact('title'));
    }

    public function forgot_password()
    {
        $title = __('forgot_password');
        return view('admins::admins.pages.auth.forgot_password', compact('title'));
    }

    public function reset_password()
    {
        $title = __('reset_password');
        return view('admins::admins.pages.auth.reset_password', compact('title'));
    }
}
