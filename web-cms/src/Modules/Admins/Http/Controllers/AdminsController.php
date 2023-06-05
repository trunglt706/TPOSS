<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admins\Entities\Admins;

class AdminsController extends Controller
{
    public function index()
    {
        return view('admins::admins.pages.admins.index');
    }

    public function list(Request $request)
    {
        $data = Admins::all();
    }

    public function store(Request $request)
    {
        //
    }

    public function detail($id)
    {
        return view('admins::admins.pages.admins.detail');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
