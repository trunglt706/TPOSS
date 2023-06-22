<?php

namespace Modules\Admins\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\Admins\Entities\AdminActivity;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Http\Requests\Activities\GetList;

class ActivityController extends Controller
{
    private $permission;
    public function __construct()
    {
        $this->permission = AdminPermission::with('menu')->ofExtension('admin_activities')->first();
    }

    public function index(GetList $request)
    {
        $title = __('permission_admin_activities');
        $permission = $this->permission;
        $sub_menu = null;
        if ($permission->menu) {
            $sub_menu = AdminMenus::parentId($permission->menu->parent_id)->get();
        }

        $_search = $request->search ?? '';
        $_admin_id = $request->admin_id ?? '';
        $_permission_id = $request->permission_id ?? '';
        $_role_id = $request->role_id ?? '';
        $limit = $request->limit ?? 20;
        $from = $request->from ?  Carbon::parse($request->from)->startOfDay() : Carbon::now()->startOfDay();
        $to = $request->to ?  Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();

        if (!auth()->guard(AUTH_ADMIN)->can(IS_ADMIN) && auth()->guard(AUTH_ADMIN)->can($permission->extension . '|view_owe')) {
            $_admin_id = auth()->guard(AUTH_ADMIN)->user()->id;
        }

        $data = AdminActivity::between($from, $to);
        $data = $_search != '' ? $data->search($_search) : $data;
        $data = $_admin_id != '' ? $data->adminId($_admin_id) : $data;
        $data = $_permission_id != '' ? $data->permissionId($_permission_id) : $data;
        $data = $_role_id != '' ? $data->roleId($_role_id) : $data;

        $data = $data->lasted()->paginate($limit);

        return view('admins::admins.pages.areas.index', compact('title', 'permission', 'sub_menu', 'status', 'data'));
    }

    public function list(GetList $request)
    {
        $_search = $request->search ?? '';
        $_admin_id = $request->admin_id ?? '';
        $_permission_id = $request->permission_id ?? '';
        $_role_id = $request->role_id ?? '';
        $limit = $request->limit ?? 20;
        $from = $request->from ?  Carbon::parse($request->from)->startOfDay() : Carbon::now()->startOfDay();
        $to = $request->to ?  Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();

        if (!auth()->guard(AUTH_ADMIN)->can(IS_ADMIN) && auth()->guard(AUTH_ADMIN)->can($permission->extension . '|view_owe')) {
            $_admin_id = auth()->guard(AUTH_ADMIN)->user()->id;
        }

        $data = AdminActivity::between($from, $to);
        $data = $_search != '' ? $data->search($_search) : $data;
        $data = $_admin_id != '' ? $data->adminId($_admin_id) : $data;
        $data = $_permission_id != '' ? $data->permissionId($_permission_id) : $data;
        $data = $_role_id != '' ? $data->roleId($_role_id) : $data;

        $data = $data->lasted()->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.admins.tables.activities', compact('data'))->render()
        ];
    }

    public function detail($id)
    {
        $activity = AdminActivity::with('admin', 'permission', 'role');
        if (!auth()->guard(AUTH_ADMIN)->can(IS_ADMIN) && auth()->guard(AUTH_ADMIN)->can($permission->extension . '|view_owe')) {
            $activity = $activity->adminId(auth()->guard(AUTH_ADMIN)->user()->id);
        }
        $activity = $activity->findOrFail($id);
        return view('admins::admins.pages.activities.detail', compact('activity'));
    }
}
