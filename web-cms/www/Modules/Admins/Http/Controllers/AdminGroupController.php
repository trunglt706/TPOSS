<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
        $_has_admin = $request->has_admin ?? '';

        $limit = $request->limit ?? 20;
        $data = AdminGroup::withCount('admins');
        $data = $_status != '' ? $data->status($_status) : $data;
        $data = $_search != '' ? $data->search($_search) : $data;
        if ($_has_admin != '') {
            if ($_has_admin == 1) {
                $data = $data->has('admins');
            } else if ($_has_admin == 2) {
                $data = $data->whereDoesntHave('admins');
            }
        }

        $data = $data->latest()->paginate($limit);

        return view('admins::admins.pages.admins.groups.index', compact('title', 'permission', 'sub_menu', 'status', 'data'));
    }

    public function list(ListGroup $request)
    {
        $limit = $request->limit ?? 20;
        $status = $request->status ?? '';
        $search = $request->search ?? '';
        $_has_admin = $request->has_admin ?? '';

        $data = AdminGroup::withCount('admins');
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;
        if ($_has_admin != '') {
            if ($_has_admin == 1) {
                $data = $data->has('admins');
            } else if ($_has_admin == 2) {
                $data = $data->whereDoesntHave('admins');
            }
        }

        $data = $data->latest()->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.admins.groups.table', compact('data'))->render()
        ];
    }

    public function store(Store $request)
    {
        $data = $request->all();
        $rules = array(
            'name' => 'required'
        );
        $messages = array();
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response_controller([
                'status' => 'error',
                'message' => array_shift($error)
            ]);
        }
        try {
            DB::beginTransaction();
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
                'message' => __('create_success'),
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response_controller([
                'status' => 'error',
                'message' => __('create_fail'),
            ]);
        }
    }

    public function detail($id)
    {
        $group = AdminGroup::with('admins', 'createdBy')->findOrFail($id);
        return view('admins::admins.pages.admins.groups.detail', compact('group'));
    }

    public function update(Update $request, $id)
    {
        $data = $request->all();
        $rules = array(
            'name' => 'required'
        );
        $messages = array();
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response_controller([
                'status' => 'error',
                'message' => array_shift($error)
            ]);
        }
        try {
            DB::beginTransaction();
            $group = AdminGroup::findOrFail($id);
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
                    'message' => __('can_not_delete')
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
