<?php

namespace Modules\Admins\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\BackupDB;
use Modules\Admins\Http\Requests\Backup\Update;
use Modules\Admins\Http\Requests\BackupDB\Delete;
use Modules\Admins\Http\Requests\BackupDB\GetList;
use Modules\Admins\Http\Requests\BackupDB\Insert;

class BackupController extends Controller
{
    private $permission;
    public function __construct()
    {
        $this->permission = AdminPermission::with('menu')->ofExtension('backup_dbs')->first();
    }

    public function index(GetList $request)
    {
        $title = __('permission_backup_dbs');
        $permission = $this->permission;
        $sub_menu = null;
        if ($permission->menu) {
            $sub_menu = AdminMenus::parentId($permission->menu->parent_id)->get();
        }
        $status = BackupDB::get_status();

        $_status = $request->status ?? '';
        $_search = $request->search ?? '';

        $limit = $request->limit ?? 20;
        $from = $request->from ?  Carbon::parse($request->from)->startOfDay() : Carbon::now()->startOfDay();
        $to = $request->to ?  Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();

        $data = BackupDB::between($from, $to);
        $data = $_status != '' ? $data->status($_status) : $data;
        $data = $_search != '' ? $data->search($_search) : $data;

        $data = $data->lasted()->paginate($limit);

        return view('admins::admins.pages.backup.index', compact('title', 'permission', 'sub_menu', 'status', 'data'));
    }

    public function list(GetList $request)
    {
        $limit = $request->limit ?? 20;
        $status = $request->status ?? '';
        $search = $request->search ?? '';
        $from = $request->from ?  Carbon::parse($request->from)->startOfDay() : Carbon::now()->startOfDay();
        $to = $request->to ?  Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();

        $data = BackupDB::between($from, $to);
        $data = $status != '' ? $data->status($status) : $data;
        $data = $search != '' ? $data->search($search) : $data;

        $data = $data->lasted()->paginate($limit);
        return [
            'status' => true,
            'total' => number_format($data->total()),
            'data' => view('admins::admins.pages.admins.tables.backup', compact('data'))->render()
        ];
    }

    public function store(Insert $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            unset($data['token']);

            BackupDB::create($data);
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
        $backup = BackupDB::with('createdBy')->findOrFail($id);
        return view('admins::admins.pages.backup.detail', compact('group'));
    }

    public function update(Update $request, $id)
    {
        try {
            DB::beginTransaction();
            $backup = BackupDB::findOrFail($id);
            $data = $request->all();
            unset($data['token']);

            $backup->update($data);
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
            $check = BackupDB::max('id');
            if ($check == $id) {
                return response_controller([
                    'status' => 'error',
                    'message' => __('can_not_delete_lasted_data')
                ]);
            }
            BackupDB::find($id)->delete();
            DB::commit();
            return response_controller([
                'status' => 'success',
                'message' => __('delete_success'),
                'total' => "(" . number_format(BackupDB::count()) . ")"
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
