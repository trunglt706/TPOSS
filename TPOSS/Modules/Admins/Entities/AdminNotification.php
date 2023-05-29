<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminNotification extends Model
{
    use HasFactory;
    protected $table = 'admin_activities';

    protected $fillable = ['permission_id', 'admin_id', 'description', 'link', 'status'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const VIEWED = 1;
    const NOT_VIEW = 2;

    public function admin()
    {
        return $this->hasOne(Admins::class, 'id', 'admin_id');
    }

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

    public function scopeAdminId($query, $admin_id)
    {
        if (is_array($admin_id)) {
            return $query->whereIn('admin_id', $admin_id);
        }
        return $query->where('admin_id', $admin_id);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeViewed($query)
    {
        return $query->where('status', self::VIEWED);
    }

    public function scopeLink($query, $link)
    {
        return $query->where('link', $link);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::VIEWED => ['Đã xem', COLORS['secondary']],
            self::NOT_VIEW => ['Chưa xem', COLORS['dark']],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
