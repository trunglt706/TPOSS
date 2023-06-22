<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Http\Requests\Auth\ForgotPasswordRequest;
use Modules\Admins\Http\Requests\Auth\LoginRequest;
use Modules\Admins\Http\Requests\Auth\ResetPasswordRequest;
use Modules\Admins\Http\Requests\OtpRequest;

class AuthController extends Controller
{
    public function change_language($lang)
    {
        $locale = $lang == 'en' ? 'en' : 'vi';
        App::setLocale($locale);
        return back()->with('success', __('change_language_success'));
    }

    public function login()
    {
        $title = __('login');
        return view('admins::admins.pages.auth.login', compact('title'));
    }

    public function login_post(LoginRequest $request)
    {
        $data = $request->only(['email', 'password']);
        $admin = Admins::ofEmail($data['email'])->active()->first();
        if ($admin) {
            if ($admin->enable_two_factory == Admins::ENABLE_TWO_FACTORY) {
                $admin->enable_two_factory_code = generateRandomString();
                $admin->enable_two_factory_expire = now()->addMinutes(get_option('time-two-factory-expire', 3));
                $admin->save();
                return to_route('admin.otp');
            } else if (Auth::guard('admin')->attempt($data)) {
                $request->session()->regenerate();
                $admin->last_login = now();
                $admin->save();
                return to_route('admin.index')->with('success', __('login_success'));
            }
        }
        return back()->with('error', __('login_fail'));
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

    public function otp()
    {
        $title = __('otp');
        return view('admins::admins.pages.auth.otp', compact('title'));
    }

    public function otp_post(OtpRequest $request)
    {
        $admin = Admins::active()->twoFactoryCode($request->otp)->twoFactoryNotExpired()->first();
        if ($admin) {
            $admin->enable_two_factory_code = NULL;
            $admin->enable_two_factory_expire = NULL;
            $admin->last_login = now();
            $admin->save();

            Auth::guard(AUTH_ADMIN)->login($admin);
            return to_route('admin.index')->with('success', __('login_success'));
        }
        return back()->withError(__('validate_otp_fail'));
    }
}
