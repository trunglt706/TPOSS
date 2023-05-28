<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminPermission extends Model
{
    use HasFactory;
    protected $table = 'admin_permissions';

    protected $fillable = ['name', 'extension', 'icon', 'order', 'description', 'status'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function roles()
    {
        return $this->hasMany(AdminRole::class, 'permission_id', 'id');
    }

    public function scopeExtension($query, $extension)
    {
        return $query->where('extension', $extension);
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