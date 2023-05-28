<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminRole extends Model
{
    use HasFactory;
    protected $table = 'admin_roles';

    protected $fillable = ['permission_id', 'extension', 'icon', 'order', 'status'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function permission()
    {
        return $this->hasOne(AdminPermission::class, 'id', 'permission_id');
    }

    public function scopePermissionId($query, $permission_id)
    {
        return $query->where('permission_id', $permission_id);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}