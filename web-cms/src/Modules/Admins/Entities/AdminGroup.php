<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class AdminGroup extends Model
{
    use HasFactory;
    protected $table = 'admin_groups';

    protected $fillable = [
        'name',
        'description',
        'status',
        'image',
        'order',
        'created_by'
    ];

    protected $hidden = [
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($group) {
            $group->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            $group->order = $group->order ?? self::get_order();
        });

        static::created(function ($group) {
            // add to table admin_group_role_samples
            foreach (AdminPermission::all() as $permission) {
                AdminGroupRoleSample::firstOrCreate([
                    'permission_id' => $permission->id,
                    'group_id' => $group->id,
                    'status' => $group->id == 1 ? AdminGroupRoleSample::STATUS_ACTIVE : AdminGroupRoleSample::STATUS_SUSPEND
                ]);
                foreach (AdminRole::permissionId($permission->id)->get() as $role) {
                    AdminGroupRoleSample::firstOrCreate([
                        'permission_id' => $permission->id,
                        'group_id' => $group->id,
                        'role_id' => $role->id,
                        'status' => $group->id == 1 ? AdminGroupRoleSample::STATUS_ACTIVE : AdminGroupRoleSample::STATUS_SUSPEND
                    ]);
                }
            }
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($group) {
            $group->admins()->each(function ($admin) {
                $admin->delete();
            });
            // delete table admin_group_role_samples
            $group->role_samples()->delete();
        });
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function role_samples()
    {
        return $this->hasMany(AdminGroupRoleSample::class, 'group_id', 'id');
    }

    public function admins()
    {
        return $this->hasMany(Admins::class, 'group_id', 'id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
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

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%");
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
        $max = AdminGroup::count();
        return $max + 1;
    }
}
