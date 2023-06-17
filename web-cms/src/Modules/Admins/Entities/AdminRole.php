<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminRole extends Model
{
    use HasFactory;
    protected $table = 'admin_roles';

    protected $fillable = [
        'permission_id',
        'extension',
        'order',
        'status'
    ];

    protected $hidden = [
        'permission_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($role) {
            $role->status = $role->status ?? self::STATUS_ACTIVE;
            $role->order = $role->order ?? self::get_order($role->permission_id ?? 0);
        });

        static::created(function ($role) {
            // add to group role sample
            AdminGroup::each(function ($group) use ($role) {
                AdminGroupRoleSample::firstOrCreate([
                    'group_id' => $group->id,
                    'role_id' => $role->id,
                    'permission_id' => $role->permission_id
                ]);
            });
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($role) {
            AdminRoleDetail::roleId($role->id)->delete();
            // delete out group role sample
            AdminGroupRoleSample::roleId($role->id)->delete();
        });
    }

    const ROLE_VIEW = 'view';
    const ROLE_VIEW_OWNER = 'view_owner';
    const ROLE_INSERT = 'insert';
    const ROLE_UPDATE = 'update';
    const ROLE_DELETE = 'delete';
    const ROLE_REPORT = 'report';
    const ROLE_LOGIN = 'login';
    const ROLE_PERMISSION = 'permission';

    protected function order(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)($value)),
        );
    }

    protected function extension(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function permission()
    {
        return $this->belongsTo(AdminPermission::class,  'permission_id');
    }

    public function scopePermissionId($query, $permission_id)
    {
        if (is_array($permission_id)) {
            return $query->whereIntegerInRaw('permission_id', $permission_id);
        }
        return $query->where('permission_id', $permission_id);
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
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_order($permission_id)
    {
        $max = AdminRole::permissionId($permission_id)->count();
        return $max + 1;
    }

    public static function get_role($id = '')
    {
        $list = [
            self::ROLE_VIEW => __('role_view'),
            self::ROLE_VIEW_OWNER => __('role_view_owner'),
            self::ROLE_INSERT => __('role_insert'),
            self::ROLE_UPDATE => __('role_update'),
            self::ROLE_DELETE => __('role_delete'),
            self::ROLE_REPORT => __('role_report'),
            self::ROLE_LOGIN => __('role_login'),
            self::ROLE_PERMISSION => __('role_permission'),
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
