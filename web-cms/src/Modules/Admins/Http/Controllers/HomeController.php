<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\AdminLead;
use Modules\Admins\Entities\AdminOrder;
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
        $admins = Admins::count();
        $services = Service::count();
        $posts = Posts::count();
        $orders = AdminOrder::count();
        $customers = AdminCustomer::count();
        $leads = AdminLead::count();
        $stores = Stores::count();
        $registers = RegisterUsing::count();

        return Response::json([
            'status' => true,
            'data' => [
                'admins' => number_format($admins),
                'services' => number_format($services),
                'posts' => number_format($posts),
                'orders' => number_format($orders),
                'customers' => number_format($customers),
                'leads' => number_format($leads),
                'stores' => number_format($stores),
                'registers' => number_format($registers),
            ]
        ]);
    }

    public function telescope()
    {
    }

    public function logout()
    {
    }
}
