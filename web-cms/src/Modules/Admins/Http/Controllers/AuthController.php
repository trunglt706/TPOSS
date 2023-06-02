<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('admins::admins.pages.auth.index');
    }

    public function forgot_password()
    {
    }

    public function reset_password()
    {
    }
}
