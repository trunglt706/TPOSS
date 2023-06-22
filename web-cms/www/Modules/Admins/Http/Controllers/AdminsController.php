<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Http\Requests\DeleteAdmin;
use Modules\Admins\Http\Requests\StoreAdminRequest;
use Modules\Admins\Http\Requests\UpdateAdminRequest;

class AdminsController extends Controller
{
    private $permission;
    public function __construct()
    {
        $this->permission = AdminPermission::with('menu')->ofExtension('admins')->first();
    }

    public function index(Request $request)
    {
        $title = __('permission_admins');
        $permission = $this->permission;
        $sub_menu = null;
        if ($permission->menu) {
            $sub_menu = AdminMenus::parentId($permission->menu->parent_id)->get();
        }
        $status = Admins::get_status();
        $gender = AdminLead::get_gender();
        $groups = AdminGroup::active()->get();

        $_group_id = $request->group_id ?? '';
        $_status = $request->status ?? '';
        $_search = $request->search ?? '';

        $limit = $request->limit ?? 20;
        $data = Admins::query();
        $data = $_group_id != '' ? $data->groupId($_group_id) : $data;
        $data = $_status != '' ? $data->status($_status) : $data;
        $data = $_search != '' ? $data->search($_search) : $data;

        $data = $data->orderBy('root', 'desc')->orderBy('supper', 'desc')
            ->orderBy('last_login', 'desc')->orderBy('created_at', 'desc')->paginate($limit);

        return view('admins::admins.pages.admins.index', compact('title', 'gender', 'permission', 'sub_menu', 'status', 'groups', 'data'));
    }

    public function list(Request $request)
    {
        $limit = $request->limit ?? 20;
        $group_id = $request->group_id ?? '';
        $status = $request->status ?? '';
        $search = $request->search ?? '';

        $data = Admins::query();
        $data = $group_id != '' ? $data->groupId($group_id) : $data;
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;

        $data = $data->orderBy('root', 'desc')->orderBy('supper', 'desc')
            ->orderBy('last_login', 'desc')->orderBy('created_at', 'desc')->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.admins.tables.admins', compact('data'))->render()
        ];
    }

    public function assigned(Request $request)
    {
        $id = $request->id ?? 0;
        $admin = Admins::findOrFail($request->id);
        $clone = Admins::active();
        if ($admin->supper) {
            $admins = $clone->clone()->isSupper()->get();
        } else {
            $admins = $clone->clone()->where('id', '<>', $admin->id)->get();
        }
        return [
            'status' => true,
            'data' => view('admins::admins.pages.admins.modals.admins', compact('admins', 'id'))->render()
        ];
    }

    public function store(StoreAdminRequest $request)
    {
        $data = $request->only('name', 'phone', 'email', 'address', 'gender', 'birthday', 'group_id', 'password', 'supper', 'tax_code', 'avatar');
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            'gender' => 'in:0,1,2',
            'group_id' => 'required|exists:admin_groups,id'
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
            $data['supper'] = isset($data['supper']) ? true : false;

            if ($request->has('avatar')) {
                $path = Storage::disk('s3')->put('images/admins/', $request->image);
                $path = Storage::disk('s3')->url($path);
                $data['avatar'] = $path;
            }
            Admins::create($data);
            DB::commit();
            return response_controller([
                'status' => 'success',
                'message' => __('store_success')
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response_controller([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function detail($id)
    {
        $admin = Admins::with('group', 'role_details', 'activities', 'orders', 'createdBy', 'storeAssigned')->findOrFail($id);
        return view('admins::admins.pages.admins.detail', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $admin = Admins::findOrFail($id);
            $data = $request->all();
            unset($data['token']);

            if ($request->has('avatar')) {
                $path = Storage::disk('s3')->put('images', $request->image);
                $path = Storage::disk('s3')->url($path);
                $data['avatar'] = $path;
            }

            $admin->update($data);
            DB::commit();
            return response_controller([
                'status' => 'success',
                'message' => __('update_success')
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response_controller([
                'status' => 'error',
                'message' => __('update_fail')
            ]);
        }
    }

    public function destroy($id, DeleteAdmin $request)
    {
        try {
            DB::beginTransaction();
            // assign customer
            AdminCustomer::ofAssigned($id)->update(['assigned_id' => $request->assigned_id]);
            // assign lead
            AdminLead::ofAssigned($id)->update(['assigned_id' => $request->assigned_id]);
            // delete admin
            Admins::find($id)->delete();
            DB::commit();
            return response_controller([
                'status' => 'success',
                'total' => "(" . number_format(Admins::count()) . ")",
                'message' => __('delete_success')
            ]);
        } catch (\Throwable $th) {
            showLog($th);
            return response_controller([
                'status' => 'error',
                'total' => "(" . number_format(Admins::count()) . ")",
                'message' => __('delete_fail')
            ]);
        }
    }
}
