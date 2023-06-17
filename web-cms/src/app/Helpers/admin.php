<?php

use Modules\Admins\Entities\AdminMenus;
use Modules\Admins\Entities\AdminSetting;
use Illuminate\Support\Str;

if (!function_exists('get_option')) {
    function get_option($code, $default = '')
    {
        $option = AdminSetting::ofCode($code)->first();
        return $option->value ?? $default;
    }
}

if (!function_exists('admin_menu_check_show_main')) {
    function admin_menu_check_show_main($item)
    {
        return allows($item->extension) && !is_null($item->extension) || (is_null($item->extension) && $item->roles_count > 0);
    }
}
if (!function_exists('admin_menu_check_role')) {
    function admin_menu_check_role($role)
    {
        $user = auth(AUTH_ADMIN)->user();
        return $user->can(IS_ADMIN) || $user->can($role->extension . '|' . ROLE_VIEW) || $user->can($role->extension . '|' . ROLE_VIEW_OWNER);
    }
}
if (!function_exists('admin_menu_sub')) {
    function admin_menu_sub($menu)
    {
        $list = [];
        $user = auth(AUTH_ADMIN)->user();
        AdminMenus::with('permission')->parentId($menu->parent_id)->active()->each(function ($role) use ($user) {
            if ($user->can(IS_ADMIN) || $user->can($role->extension . '|' . ROLE_VIEW) || $user->can($role->extension . '|' . ROLE_VIEW_OWNER)) {
                $list[] = [
                    'name' => __($role->name),
                    'route' => $role->route,
                    'icon' => $role->icon
                ];
            }
        });
        return $list;
    }
}
if (!function_exists('admin_get_full_link_host')) {
    function admin_get_full_link_host($route_name)
    {
        $route = route($route_name);
        return isProduction() ? $route : Str::after($route, env('APP_URL'));
    }
}
