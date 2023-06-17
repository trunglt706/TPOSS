<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Http\Requests\DeleteAdmin;

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
        $search = $request->search ?? '';

        $data = Admins::query();
        $data = $group_id != '' ? $data->groupId($group_id) : $data;
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;

        $data = $data->orderBy('root', 'desc')->orderBy('supper', 'desc')
            ->orderBy('last_login', 'desc')->paginate($limit);
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
        if ($admin->supper) {
            $admins = Admins::active()->isSupper()->get();
        } else {
            $admins = Admins::active()->where('id', '<>', $admin->id)->get();
        }
        return [
            'status' => true,
            'data' => view('admins::admins.pages.admins.modals.admins', compact('admins', 'id'))->render()
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
            return [
                'status' => true,
                'message' => __('delete_data_success')
            ];
        } catch (\Throwable $th) {
            showLog($th);
            return [
                'status' => false,
                'message' => __('delete_data_fail')
            ];
        }
    }
}
