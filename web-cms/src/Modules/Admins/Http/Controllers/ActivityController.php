<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        return view('admins::index');
    }

    public function list()
    {
        return view('admins::index');
    }

    public function detail($id)
    {
        return view('admins::index');
    }
}
