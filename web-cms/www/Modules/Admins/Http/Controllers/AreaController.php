<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\Area;
use Modules\Admins\Http\Requests\Area\Delete;
use Modules\Admins\Http\Requests\Area\GetList;
use Modules\Admins\Http\Requests\Area\Insert;
use Modules\Admins\Http\Requests\Area\Update;

class AreaController extends Controller
{
    private $permission;
    public function __construct()
    {
        $this->permission = AdminPermission::with('menu')->ofExtension('admin_areas')->first();
    }

    public function index(GetList $request)
    {
        $title = __('permission_admin_areas');
        $permission = $this->permission;
        $sub_menu = null;
        if ($permission->menu) {
            $sub_menu = AdminMenus::parentId($permission->menu->parent_id)->get();
        }
        $status = Area::get_status();

        $_status = $request->status ?? '';
        $_search = $request->search ?? '';
        $_has_customer = $request->has_customer ?? '';

        $limit = $request->limit ?? 20;
        $data = Area::withCount('customers');
        $data = $_status != '' ? $data->status($_status) : $data;
        $data = $_search != '' ? $data->search($_search) : $data;
        if ($_has_customer != '') {
            if ($_has_customer == 1) {
                $data = $data->has('customers');
            } else if ($_has_customer == 2) {
                $data = $data->whereDoesntHave('customers');
            }
        }

        $data = $data->latest()->paginate($limit);

        return view('admins::admins.pages.other.areas.index', compact('title', 'permission', 'sub_menu', 'status', 'data'));
    }

    public function list(GetList $request)
    {
        $limit = $request->limit ?? 20;
        $status = $request->status ?? '';
        $search = $request->search ?? '';
        $_has_customer = $request->has_customer ?? '';

        $data = Area::withCount('customers');
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;
        if ($_has_customer != '') {
            if ($_has_customer == 1) {
                $data = $data->has('customers');
            } else if ($_has_customer == 2) {
                $data = $data->whereDoesntHave('customers');
            }
        }

        $data = $data->latest()->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.other.areas.table', compact('data'))->render()
        ];
    }

    public function store(Insert $request)
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

            Area::create($data);
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
        $group = Area::with('customers', 'createdBy')->findOrFail($id);
        return view('admins::admins.pages.other.areas.detail', compact('group'));
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
            $group = Area::findOrFail($id);
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
