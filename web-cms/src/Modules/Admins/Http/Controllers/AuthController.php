<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Http\Requests\Auth\ForgotPasswordRequest;
use Modules\Admins\Http\Requests\Auth\LoginRequest;
use Modules\Admins\Http\Requests\Auth\ResetPasswordRequest;

class AuthController extends Controller
{
    public function login()
    {
        return AdminMenus::load_menus();
        $title = __('login');
        return view('admins::admins.pages.auth.login', compact('title'));
    }

    public function login_post(LoginRequest $request)
    {
        $data = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($data)) {
            $admin = Admins::ofEmail($data['email'])->active()->first();
            if ($admin) {
                $request->session()->regenerate();
                $admin->last_login = now();
                $admin->save();
                return to_route('admin.index')->withSuccess('Đăng nhập thành công');
            }
        }
        return back()->withError('Đăng nhập thất bại!');
    }

    public function forgot_password()
    {
        $title = __('forgot_password');
        return view('admins::admins.pages.auth.forgot_password', compact('title'));
    }

    public function forgot_password_post(ForgotPasswordRequest $request)
    {
    }

    public function reset_password()
    {
        $title = __('reset_password');
        return view('admins::admins.pages.auth.reset_password', compact('title'));
    }

    public function reset_password_post(ResetPasswordRequest $request)
    {
    }
}
