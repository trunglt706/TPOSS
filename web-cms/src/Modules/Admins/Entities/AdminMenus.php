<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminMenus extends Model
{
    use HasFactory;
    protected $table = 'admin_menus';

    protected $fillable = [
        'permission_id',
        'type',
        'status',
        'route',
        'target',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const TYPE_MAIN = 1;
    const TYPE_SUB = 0;

    public function permission()
    {
        return $this->hasOne(AdminPermission::class, 'id', 'permission_id');
    }

    public function scopePermissionId($query, $permission_id)
    {
        if (is_array($permission_id)) {
            return $query->whereIn('permission_id', $permission_id);
        }
        return $query->where('permission_id', $permission_id);
    }

    public function scopeType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }

    public function scopeRoute($query, $route)
    {
        if (is_array($route)) {
            return $query->whereIn('route', $route);
        }
        return $query->where('route', $route);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('admins::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('admins::status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_MAIN => [__('admins::menu_type_1'), COLORS['success']],
            self::TYPE_SUB => [__('admins::menu_type_0'), COLORS['warning']],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
