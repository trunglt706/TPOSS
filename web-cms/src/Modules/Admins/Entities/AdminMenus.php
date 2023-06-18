<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class AdminMenus extends Model
{
    use HasFactory;
    protected $table = 'admin_menus';

    protected $fillable = [
        'name',
        'type',
        'status',
        'route',
        'target',
        'parent_id',
        'icon',
        'order',
        'extension'
    ];

    protected $hidden = [
        // 'parent_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $parent_id = $model->parent_id ?? 0;
            $model->status = $model->status ?? self::STATUS_ACTIVE;
            $model->type = $model->type ?? self::TYPE_MAIN;
            $model->target = $model->target ?? self::TARGET_SELF;
            $model->parent_id = $parent_id;
            $model->order = $model->order ?? self::get_order($parent_id);
        });

        static::created(function ($model) {
            self::load_menus();
        });

        static::updating(function ($model) {
            self::load_menus();
        });

        static::updated(function ($model) {
            self::load_menus();
        });

        static::deleted(function ($model) {
            $model->roles()->delete();
            self::load_menus();
        });
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const TYPE_MAIN = 1;
    const TYPE_SUB = 0;
    const TYPE_HEADER = 2;

    const TARGET_SELF = 'self';
    const TARGET_BLANK = '_blank';

    public function permission()
    {
        return $this->belongsTo(AdminPermission::class, 'extension', 'extension');
    }

    public function roles()
    {
        return $this->hasMany(AdminMenus::class, 'parent_id', 'id')->active();
    }

    public function scopeOfType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }

    public function scopeOfExtension($query, $extension)
    {
        if (is_array($extension)) {
            return $query->whereIn('extension', $extension);
        }
        return $query->where('extension', $extension);
    }

    public function scopeOfName($query, $name)
    {
        if (is_array($name)) {
            return $query->whereIn('name', $name);
        }
        return $query->where('name', $name);
    }

    public function scopeOfRoute($query, $route)
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

    public function scopeParentId($query, $parent_id)
    {
        return $query->where('parent_id', $parent_id);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_MAIN => [__('menu_type_1'), COLORS['success']],
            self::TYPE_SUB => [__('menu_type_0'), COLORS['warning']],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_order($parent_id = 0)
    {
        $max = AdminMenus::parentId($parent_id)->count();
        return $max + 1;
    }

    public static function load_menus()
    {
        Cache::forget('menu_admin');
        $menu_admin = Cache::rememberForever('menu_admin', function () {
            $menu_admin = AdminMenus::with('roles')->withCount('roles')
                ->ofType([AdminMenus::TYPE_MAIN, AdminMenus::TYPE_HEADER])
                ->parentId(0)
                ->active()
                ->order()
                ->get();
            return $menu_admin;
        });
        return $menu_admin;
    }
}
