<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\Admins;

class AdminsController extends Controller
{
    private $permission;
    public function __construct()
    {
        $this->permission = AdminPermission::with('menu')->ofExtension('admins')->first();
    }

    public function index()
    {
        $title = __('permission_admins');
        $permission = $this->permission;
        $menu = null;
        if ($permission->menu) {
            $menu = AdminMenus::parentId($permission->menu->id)->get();
        }
        $status = Admins::get_status();
        $groups = AdminGroup::active()->get();
        $data = Admins::orderBy('root', 'desc')->orderBy('supper', 'desc')
            ->orderBy('last_login', 'desc')->paginate(10);
        return view('admins::admins.pages.admins.index', compact('title', 'permission', 'menu', 'status', 'groups', 'data'));
    }

    public function list(Request $request)
    {
        $limit = $request->limit ?? 10;
        $group_id = $request->group_id ?? '';
        $status = $request->status ?? '';

        $data = Admins::query();
        $data = $group_id != '' ? $data->groupId($group_id) : $data;
        $data = $status != '' ? $data->status($status) : $data;

        $data = $data->orderBy('root', 'desc')->orderBy('supper', 'desc')
            ->orderBy('last_login', 'desc')->paginate($limit);
        return [
            'status' => true,
            'data' => view('admins::admins.pages.admins.tables.admins', compact('data'))->render()
        ];
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
