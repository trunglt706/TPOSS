<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminSetting;

class AdminComposer
{
    /**
     * Create a new profile composer.
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * 
     * @param View $view
     */
    public function compose(View $view)
    {
        // get menus
        if (Cache::has('menu_admin')) {
            $menu_admin = Cache::get('menu_admin');
        } else {
            $menu_admin = AdminMenus::load_menus();
        }
        $view->with('menu_admin', $menu_admin);

        if (Cache::has('setting_admin')) {
            $setting_admin = Cache::get('setting_admin');
        } else {
            $setting_admin = AdminSetting::cache_all_setting();
        }
        $view->with('setting_admin', $setting_admin);
    }
}