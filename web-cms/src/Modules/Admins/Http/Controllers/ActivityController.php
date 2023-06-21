<?php

namespace Modules\Admins\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $limit = $request->limit ?? 20;
        $from = $request->from ?  Carbon::parse($request->from)->startOfDay() : Carbon::now()->startOfDay();
        $to = $request->to ?  Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();

        $data = AdminActivity::between($from, $to);
        $data = $_search != '' ? $data->search($_search) : $data;

        $data = $data->orderBy('order', 'desc')->lasted()->paginate($limit);

        return view('admins::admins.pages.areas.index', compact('title', 'permission', 'sub_menu', 'status', 'data'));
    }

    public function list(GetList $request)
    {
        $limit = $request->limit ?? 20;
        $status = $request->status ?? '';
        $search = $request->search ?? '';

        $data = AdminActivity::withCount('admins');
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;

        $data = $data->orderBy('order', 'desc')->lasted()->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.admins.tables.activities', compact('data'))->render()
        ];
    }

    public function detail($id)
    {
        $activity = AdminActivity::with('admin', 'permission', 'role')->findOrFail($id);
        return view('admins::admins.pages.activities.detail', compact('activity'));
    }
}
