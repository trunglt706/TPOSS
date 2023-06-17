<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminOrder;
use Modules\Admins\Entities\AdminPermission;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Entities\Posts;
use Modules\Admins\Entities\RegisterUsing;
use Modules\Admins\Entities\Service;
use Modules\Stores\Entities\Stores;

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
}
