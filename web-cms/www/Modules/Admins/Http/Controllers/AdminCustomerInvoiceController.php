<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admins\Entities\AdminPermission;

class AdminCustomerInvoiceController extends Controller
{

    private $permission;
    public function __construct()
    {
        $this->permission = AdminPermission::with('menu')->ofExtension('admin_groups')->first();
    }

    public function index(GetList $request)
    {
        $title = __('permission_admin_groups');
        $permission = $this->permission;
        $sub_menu = null;
        if ($permission->menu) {
            $sub_menu = AdminMenus::parentId($permission->menu->parent_id)->get();
        }
        $status = Area::get_status();

        $_status = $request->status ?? '';
        $_search = $request->search ?? '';

        $limit = $request->limit ?? 20;
        $data = Area::withCount('customers');
        $data = $_status != '' ? $data->status($_status) : $data;
        $data = $_search != '' ? $data->search($_search) : $data;

        $data = $data->orderBy('order', 'desc')->latest()->paginate($limit);

        return view('admins::admins.pages.areas.index', compact('title', 'permission', 'sub_menu', 'status', 'data'));
    }

    public function list(GetList $request)
    {
        $limit = $request->limit ?? 20;
        $status = $request->status ?? '';
        $search = $request->search ?? '';

        $data = Area::withCount('admins');
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;

        $data = $data->orderBy('order', 'desc')->latest()->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.admins.tables.admin_groups', compact('data'))->render()
        ];
    }

    public function store(Insert $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            unset($data['token']);

            Area::create($data);
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
        $group = Area::with('admins', 'role_samples', 'createdBy')->findOrFail($id);
        return view('admins::admins.pages.areas.detail', compact('group'));
    }

    public function update(Update $request, $id)
    {
        try {
            DB::beginTransaction();
            $group = Area::findOrFail($id);
            $data = $request->all();
            unset($data['token']);

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
            $check = AdminCustomer::areaId($id)->count();
            if ($check > 0) {
                return response_controller([
                    'status' => 'error',
                    'message' => __('can_not_delete')
                ]);
            }
            Area::find($id)->delete();
            DB::commit();
            return response_controller([
                'status' => 'success',
                'message' => __('delete_success'),
                'total' => "(" . number_format(Area::count()) . ")"
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
