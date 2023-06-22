<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminPermission extends Model
{
    use HasFactory;
    protected $table = 'admin_permissions';

    protected $fillable = [
        'name',
        'extension',
        'icon',
        'order',
        'description',
        'status',
        'group'
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($permission) {
            $permission->order = $permission->order ?? self::get_order();
            $permission->status = $permission->status ?? self::STATUS_ACTIVE;
        });

        static::created(function ($permission) {
            // add to group role sample
            AdminGroup::each(function ($group) use ($permission) {
                AdminGroupRoleSample::firstOrCreate([
                    'permission_id' => $permission->id,
                    'group_id' => $group->id,
                    'status' => AdminGroupRoleSample::STATUS_SUSPEND
                ]);
            });
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($permission) {
            $permission->roles()->delete();
            $permission->settings()->delete();
            // delete out group role sample
            AdminGroupRoleSample::permissionId($permission->id)->delete();
        });
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function settings()
    {
        return $this->hasMany(AdminSetting::class, 'permission_id', 'id');
    }

    public function menu()
    {
        return $this->hasOne(AdminMenus::class, 'extension', 'extension');
    }

    public function roles()
    {
        return $this->hasMany(AdminRole::class, 'permission_id', 'id');
    }

    public function scopeOfExtension($query, $extension)
    {
        if (is_array($extension)) {
            return $query->whereIn('extension', $extension);
        }
        return $query->where('extension', $extension);
    }

    public function scopeOfGroup($query, $group)
    {
        if (is_array($group)) {
            return $query->whereIn('group', $group);
        }
        return $query->where('group', $group);
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

    public static function get_order()
    {
        $max = AdminPermission::count();
        return $max + 1;
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('extension', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%");
        });
    }
}
