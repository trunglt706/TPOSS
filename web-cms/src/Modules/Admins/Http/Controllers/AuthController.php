<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->post()) {
            return 1;
        }
        return view('admins::admins.pages.auth.login');
    }

    public function forgot_password()
    {
    }

    public function reset_password()
    {
    }
}
