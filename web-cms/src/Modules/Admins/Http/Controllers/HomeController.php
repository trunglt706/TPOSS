<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminOrder;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Entities\Area;
use Modules\Admins\Entities\Posts;
use Modules\Admins\Entities\RegisterUsing;
use Modules\Admins\Entities\Service;
use Modules\Stores\Entities\Stores;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;

class HomeController extends Controller
{
    public function index()
    {
        return view('admins::admins.pages.home.index');
    }

    public function home_header()
    {
        $data = [];
        if (admin_menu_check_role('admins')) {
            $per = AdminPermission::ofExtension('admins')->first();
            if ($per) {
                array_push($data, [
                    'total' => Admins::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'success',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }
        if (admin_menu_check_role('services')) {
            $per = AdminPermission::ofExtension('services')->first();
            if ($per) {
                array_push($data, [
                    'total' => Service::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'info',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }
        if (admin_menu_check_role('admin_customers')) {
            $per = AdminPermission::ofExtension('admin_customers')->first();
            if ($per) {
                array_push($data, [
                    'total' => AdminCustomer::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'warning',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }
        if (admin_menu_check_role('admin_leads')) {
            $per = AdminPermission::ofExtension('admin_leads')->first();
            if ($per) {
                array_push($data, [
                    'total' => AdminLead::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'danger',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }
        if (admin_menu_check_role('stores')) {
            $per = AdminPermission::ofExtension('stores')->first();
            if ($per) {
                array_push($data, [
                    'total' => Stores::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'danger',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }
        if (admin_menu_check_role('register_usings')) {
            $per = AdminPermission::ofExtension('register_usings')->first();
            if ($per) {
                array_push($data, [
                    'total' => RegisterUsing::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'info',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }
        if (admin_menu_check_role('admin_orders')) {
            $per = AdminPermission::ofExtension('admin_orders')->first();
            if ($per) {
                array_push($data, [
                    'total' => AdminOrder::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'secondary',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }
        if (admin_menu_check_role('posts')) {
            $per = AdminPermission::ofExtension('posts')->first();
            if ($per) {
                array_push($data, [
                    'total' => Posts::count(),
                    'icon' => $per->icon,
                    'name' => __($per->name),
                    'color' => 'primary',
                    'href' => route("admin.$per->extension.index")
                ]);
            }
        }

        return [
            'status' => true,
            'data' => view('admins::admins.pages.home.header', compact('data'))->render()
        ];
    }

    public function home_activity()
    {
    }

    public function home_revenue()
    {
    }

    public function home_register()
    {
        $list = RegisterUsing::select(DB::raw('count(*) as total'), 'status', DB::raw('date(created_at) as date'))
            ->groupBy('date', 'status')->orderBy('date', 'desc')->get();
        $data = [];
        $color = [];
        foreach ($list as $item) {
            $color = RegisterUsing::get_status($item->status);
            array_push($data, [
                'name' => $color[0],
                'data' => [],
            ]);
            array_push($color, $color[1]);
        }
        return $data;
    }

    public function home_leads()
    {
    }

    public function telescope()
    {
    }

    public function logout()
    {
        Auth::guard(AUTH_ADMIN)->logout();
        return to_route('admin.login')->with('success', 'Đăng xuất thành công');
    }

    public function global($type, Request $request)
    {
        $query = null;
        $response = [];
        $search = $request->search ?? '';
        $id = $request->id ?? '';
        $admin = auth()->guard(AUTH_ADMIN)->user();

        switch ($type) {
            case 'provinces':
                if (allows('provinces')) {
                    $query =  Province::where('name', 'LIKE', "%$search%");
                    $response = self::get_data_response($query, 'name_with_type');
                }
                break;
            case 'districts':
                if (allows('districts')) {
                    $query =  District::where('name', 'LIKE', "%$search%");
                    if ($id != '') {
                        $query = $query->whereHas('province', function ($query) use ($id) {
                            $query->where('id', $id);
                        });
                        $response = self::get_data_response($query, 'name_with_type');
                    }
                }
                break;
            case 'wards':
                if (allows('wards')) {
                    $query =  Ward::where('name', 'LIKE', "%$search%");
                    if ($id != '') {
                        $query = $query->whereHas('district', function ($query) use ($id) {
                            $query->where('id', $id);
                        });
                        $response = self::get_data_response($query, 'name_with_type');
                    }
                }
                break;
            case 'admin_areas':
                if (allows('admin_areas')) {
                    $query =  Area::active()->search($search);
                    $response = self::get_data_response($query);
                }
                break;
            case 'admin_groups':
                if (allows('admin_groups')) {
                    $query =  AdminGroup::active()->search($search);
                    $response = self::get_data_response($query);
                } else {
                    $query =  AdminGroup::active()->whereId($admin->group_id ?? 0);
                    $response = self::get_data_response($query);
                }
                break;
            case 'admins':
                if (allows('')) {
                    $query =  Admins::active()->search($search);
                    $response = self::get_data_response($query);
                } else {
                    $query =  Admins::active()->whereId($admin->id);
                    $response = self::get_data_response($query);
                }
                break;
            default:
                break;
        }

        if (count($response) == 0) {
            $data['pagination'] = ["more" => false];
        } else {
            $data['pagination'] = ["more" => true];
        }
        $data['results'] = $response;
        return response()->json($data);
    }

    public function get_data_response($query, $key = 'name')
    {
        $data = $query->paginate(10);
        $response[] = [
            'id' => '',
            'text' => __('all')
        ];
        foreach ($data as $item) {
            $response[] = [
                'id' => $item->id,
                'text' => $item->$key
            ];
        }
        return $response;
    }
}
