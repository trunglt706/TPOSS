<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Http\Requests\AdminGroup\Delete;
use Modules\Admins\Http\Requests\AdminGroup\Store;
use Modules\Admins\Http\Requests\AdminGroup\Update;
use Modules\Admins\Http\Requests\AdminGroup\ListGroup;

class AdminGroupController extends Controller
{
    private $permission;
    public function __construct()
    {
        $this->permission = AdminPermission::with('menu')->ofExtension('admin_groups')->first();
    }

    public function index(ListGroup $request)
    {
        $title = __('permission_admin_groups');
        $permission = $this->permission;
        $sub_menu = null;
        if ($permission->menu) {
            $sub_menu = AdminMenus::parentId($permission->menu->parent_id)->get();
        }
        $status = AdminGroup::get_status();

        $_status = $request->status ?? '';
        $_search = $request->search ?? '';

        $limit = $request->limit ?? 10;
        $data = AdminGroup::withCount('admins');
        $data = $_status != '' ? $data->status($_status) : $data;
        $data = $_search != '' ? $data->search($_search) : $data;

        $data = $data->orderBy('order', 'desc')->orderBy('created_at', 'desc')->paginate($limit);

        return view('admins::admins.pages.admin_groups.index', compact('title', 'permission', 'sub_menu', 'status', 'data'));
    }

    public function list(ListGroup $request)
    {
        $limit = $request->limit ?? 10;
        $status = $request->status ?? '';
        $search = $request->search ?? '';

        $data = AdminGroup::withCount('admins');
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;

        $data = $data->orderBy('order', 'desc')->orderBy('created_at', 'desc')->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.admins.tables.admin_groups', compact('data'))->render()
        ];
    }

    public function store(Store $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            unset($data['token']);

            if ($request->has('image')) {
                $path = Storage::disk('s3')->put('images/admin_groups/', $request->image);
                $path = Storage::disk('s3')->url($path);
                $data['avatar'] = $path;
            }
            AdminGroup::create($data);
            DB::commit();
            return response_controller([
                'status' => 'success',
                'message' => __('update_success'),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response_controller([
                'status' => 'error',
                'message' => __('update_fail'),
            ]);
        }
    }

    public function detail($id)
    {
        $group = AdminGroup::with('admins', 'role_samples', 'createdBy')->findOrFail($id);
        return view('admins::admins.pages.admin_groups.detail', compact('group'));
    }

    public function update(Update $request, $id)
    {
        try {
            DB::beginTransaction();
            $group = AdminGroup::findOrFail($id);
            $data = $request->all();
            unset($data['token']);

            if ($request->has('image')) {
                $path = Storage::disk('s3')->put('images/admin_groups/', $request->image);
                $path = Storage::disk('s3')->url($path);
                $data['avatar'] = $path;
            }

            $group->update($data);
            DB::commit();
            return response_controller([
                'status' => 'success',
                'message' => __('update_success'),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response_controller([
                'status' => 'error',
                'message' => __('update_fail'),
            ]);
        }
    }

    public function destroy($id, Delete $request)
    {
        try {
            DB::beginTransaction();
            $check = Admins::groupId($id)->count();
            if ($check > 0) {
                return response_controller([
                    'status' => 'error',
                    'message' => 'Không thể xóa do có phát sinh dữ liệu'
                ]);
            }
            AdminGroup::find($id)->delete();
            DB::commit();
            return response_controller([
                'status' => 'success',
                'message' => __('delete_success'),
                'total' => "(" . number_format(AdminGroup::count()) . ")"
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response_controller([
                'status' => 'error',
                'message' => __('delete_fail')
            ]);
        }
    }
}
