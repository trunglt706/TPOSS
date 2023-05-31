<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminGroupRoleSample extends Model
{
    use HasFactory;
    protected $table = 'admin_group_role_samples';

    protected $fillable = [
        'permission_id',
        'group_id',
        'role_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function permission()
    {
        return $this->hasOne(AdminPermission::class, 'id', 'permission_id');
    }

    public function role()
    {
        return $this->hasOne(AdminRole::class, 'id', 'role_id');
    }

    public function group()
    {
        return $this->hasOne(AdminGroup::class, 'id', 'group_id');
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
}
