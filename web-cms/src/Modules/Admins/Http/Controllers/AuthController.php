<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('admins::admins.pages.auth.login');
    }

    public function forgot_password()
    {
        return view('admins::admins.pages.auth.forgot_password');
    }

    public function reset_password()
    {
        return view('admins::admins.pages.auth.reset_password');
    }
}
